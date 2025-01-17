<?php
namespace Modules\Job\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Booking\Models\Booking;
use Modules\FrontendController;
use Modules\Job\Models\Job;
use Modules\Job\Models\JobRoom;
use Modules\Job\Models\JobRoomBooking;
use Modules\Job\Models\JobRoomDate;
class AvailabilityController extends FrontendController{
    protected $roomClass;
    /**
     * @var JobRoomDate
     */
    protected $roomDateClass;
    /**
     * @var Booking
     */
    protected $bookingClass;
    protected $JobClass;
    protected $currentJob;
    protected $roomBookingClass;
    protected $indexView = 'Job::frontend.user.availability';
    public function __construct()
    {
        parent::__construct();
        $this->roomClass = JobRoom::class;
        $this->roomDateClass = JobRoomDate::class;
        $this->bookingClass = Booking::class;
        $this->JobClass = Job::class;
        $this->roomBookingClass = JobRoomBooking::class;
    }
    public function callAction($method, $parameters)
    {
        if(!Job::isEnable())
        {
            return redirect('/');
        }
        return parent::callAction($method, $parameters); // TODO: Change the autogenerated stub
    }
    protected function hasJobPermission($job_id = false){
        if(empty($job_id)) return false;
        $Job = $this->JobClass::find($job_id);
        if(empty($Job)) return false;
        if(!$this->hasPermission('job_update') and $Job->create_user != Auth::id()){
            return false;
        }
        $this->currentJob = $Job;
        return true;
    }
    public function index(Request $request,$job_id){
        $this->checkPermission('job_create');
        if(!$this->hasJobPermission($job_id))
        {
            abort(403);
        }
        $q = $this->roomClass::query();
        if($request->query('s')){
            $q->where('title','like','%'.$request->query('s').'%');
        }
        $q->orderBy('id','desc');
        $q->where('parent_id',$job_id);
        $rows = $q->paginate(15);
        $current_month = strtotime(date('Y-m-01',time()));
        if($request->query('month')){
            $date = date_create_from_format('m-Y',$request->query('month'));
            if(!$date){
                $current_month = time();
            }else{
                $current_month = $date->getTimestamp();
            }
        }
        $breadcrumbs = [
            [
                'name' => __('Jobs'),
                'url'  => route('Job.vendor.index')
            ],
            [
                'name' => __('Job: :name',['name'=>$this->currentJob->title]),
                'url'  => route('Job.vendor.edit',[$this->currentJob->id])
            ],
            [
                'name'  => __('Availability'),
                'class' => 'active'
            ],
        ];
        $Job = $this->currentJob;
        $page_title = __('Room Availability');
        return view($this->indexView,compact('rows','breadcrumbs','current_month','page_title','request','Job'));
    }
    public function loadDates(Request $request,$job_id){
        $request->validate([
            'id'=>'required',
            'start'=>'required',
            'end'=>'required',
        ]);
        if(!$this->hasJobPermission($job_id))
        {
            return $this->sendError(__("Job not found"));
        }
        /**
         * @var $room JobRoom
         */
        $room = $this->roomClass::find($request->query('id'));
        if(empty($room)){
            return $this->sendError(__('room not found'));
        }
        $is_single = $request->query('for_single');
        $query = $this->roomDateClass::query();
        $query->where('target_id',$request->query('id'));
        $query->where('start_date','>=',date('Y-m-d H:i:s',strtotime($request->query('start'))));
        $query->where('end_date','<=',date('Y-m-d H:i:s',strtotime($request->query('end'))));
        $rows =  $query->take(40)->get();
        $allDates = [];
        $period = periodDate($request->input('start'),$request->input('end'));
        foreach ($period as $dt){
            $date = [
                'id'=>rand(0,999),
                'active'=>0,
                'price'=> $room->price,
                'number'=> $room->number,
                'is_instant'=>0,
                'is_default'=>true,
                'textColor'=>'#2791fe'
            ];
            $date['price_html'] = format_money($date['price']);
            if(!$is_single){
                $date['price_html'] = format_money_main($date['price']);
            }
            $date['title'] = $date['event']  = $date['price_html'];
            $date['start'] = $date['end'] = $dt->format('Y-m-d');
            $date['active'] = 1;
            $allDates[$dt->format('Y-m-d')] = $date;
        }
        if(!empty($rows))
        {
            foreach ($rows as $row)
            {
                $row->start = date('Y-m-d',strtotime($row->start_date));
                $row->end = date('Y-m-d',strtotime($row->start_date));
                $row->textColor = '#2791fe';
                $price = $row->price;
                if(empty($price)){
                    $price = $room->price;
                }
                $row->title = $row->event = format_money($price);
                if(!$is_single){
                    $row->title = $row->event = format_money_main($price);
                }
                $row->price = $price;
                if(!$row->active)
                {
                    $row->title = $row->event = __('Blocked');
                    $row->backgroundColor = '#fe2727';
                    $row->classNames = ['blocked-event'];
                    $row->textColor = '#fe2727';
                    $row->active = 0;
                }else{
                    $row->classNames = ['active-event'];
                    $row->active = 1;
//                    if($row->is_instant){
//                        $row->title = '<i class="fa fa-bolt"></i> '.$row->title;
//                    }
                }
                $allDates[date('Y-m-d',strtotime($row->start_date))] = $row->toArray();
            }
        }
        $bookings = $room->getBookingsInRange($request->query('start'),$request->query('end'));
        if(!empty($bookings))
        {
            foreach ($bookings as $booking){
                $period = periodDate($booking->start_date,$booking->end_date);
                foreach ($period as $dt){
                    $date = $dt->format('Y-m-d');
                    if(isset($allDates[$date])){
                        $allDates[$date]['number'] -= $booking->number;
                        if($allDates[$date]['number'] <=0 ){
                            $allDates[$date]['active'] = 0;
                            $allDates[$date]['event'] = __('Full Book');
                            $allDates[$date]['title'] = __('Full Book');
                            $allDates[$date]['classNames'] = ['full-book-event'];
                        }
                    }
                }
            }
        }
        $data = array_values($allDates);
        return response()->json($data);
    }
    public function store(Request $request,$job_id){
        if(!$this->hasJobPermission($job_id))
        {
            return $this->sendError(__("Job not found"));
        }
        $request->validate([
            'target_id'=>'required',
            'start_date'=>'required',
            'end_date'=>'required'
        ]);
        $room = $this->roomClass::find($request->input('target_id'));
        $target_id = $request->input('target_id');
        if(empty($room)){
            return $this->sendError(__('Room not found'));
        }
        if(!$this->hasPermission('job_manage_others')){
            if($this->currentJob->create_user != Auth::id()){
                return $this->sendError("You do not have permission to access it");
            }
        }
        $postData = $request->input();
        $period = periodDate($request->input('start_date'),$request->input('end_date'));
        foreach ($period as $dt){
            $date = $this->roomDateClass::where('start_date',$dt->format('Y-m-d'))->where('target_id',$target_id)->first();
            if(empty($date)){
                $date = new $this->roomDateClass();
                $date->target_id = $target_id;
            }
            $postData['start_date'] = $dt->format('Y-m-d H:i:s');
            $postData['end_date'] = $dt->format('Y-m-d H:i:s');
            $date->fillByAttr([
                'start_date','end_date','price',
//                'max_guests','min_guests',
                'is_instant','active',
                'number'
            ],$postData);
            $date->save();
        }
        return $this->sendSuccess([],__("Update Success"));
    }
}
