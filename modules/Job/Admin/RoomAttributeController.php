<?php
namespace Modules\Job\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\AdminController;
use Modules\Core\Models\Categories;
use Modules\Core\Models\CategoriesTranslation;
use Modules\Core\Models\Terms;
use Modules\Core\Models\TermsTranslation;
use Illuminate\Support\Facades\DB;
class RoomCategoryController extends AdminController
{
    protected $categoriesClass;
    protected $termsClass;
    public function __construct()
    {
        $this->setActiveMenu('admin/module/Job');
        parent::__construct();
        $this->categoriesClass = Categories::class;
        $this->termsClass = Terms::class;
    }
    public function index(Request $request)
    {
        $this->checkPermission('job_manage_categories');
        $listAttr = $this->categoriesClass::where("service", 'job_room');
        if (!empty($search = $request->query('s'))) {
            $listAttr->where('name', 'LIKE', '%' . $search . '%');
        }
        $listAttr->orderBy('created_at', 'desc');
        $data = [
            'rows'        => $listAttr->get(),
            'row'         => new $this->categoriesClass(),
            'translation'    => new CategoriesTranslation(),
            'breadcrumbs' => [
                [
                    'name' => __('Job'),
                    'url'  => 'admin/module/Job'
                ],
                [
                    'name'  => __('Room Categories'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Job::admin.room.category.index', $data);
    }
    public function edit(Request $request, $id)
    {
        $row = $this->categoriesClass::find($id);
        if (empty($row)) {
            return redirect()->back()->with('error', __('Categories not found!'));
        }
        $translation = $row->translateOrOrigin($request->query('lang'));
        $this->checkPermission('job_manage_categories');
        $data = [
            'translation'    => $translation,
            'enable_multi_lang'=>true,
            'rows'        => $this->categoriesClass::where("service", 'job_room')->get(),
            'row'         => $row,
            'breadcrumbs' => [
                [
                    'name' => __('Job'),
                    'url'  => 'admin/module/Job'
                ],
                [
                    'name' => __('Room Categories'),
                    'url'  => 'admin/module/job/room/category'
                ],
                [
                    'name'  => __('Category: :name', ['name' => $row->name]),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Job::admin.room.category.detail', $data);
    }
    public function store(Request $request)
    {
        $this->checkPermission('job_manage_categories');
        $this->validate($request, [
            'name' => 'required'
        ]);
        $id = $request->input('id');
        if ($id) {
            $row = $this->categoriesClass::find($id);
            if (empty($row)) {
                return redirect()->back()->with('error', __('Categories not found!'));
            }
        } else {
            $row = new $this->categoriesClass($request->input());
            $row->service = 'job_room';
        }
        $row->fill($request->input());
        $res = $row->saveOriginOrTranslation($request->input('lang'));
        if ($res) {
            return redirect()->back()->with('success', __('Category saved'));
        }
    }
    public function editAttrBulk(Request $request)
    {
        $this->checkPermission('job_manage_categories');
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('Select at least 1 item!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Select an Action!'));
        }
        if ($action == "delete") {
            foreach ($ids as $id) {
                $query = $this->categoriesClass::where("id", $id);
                $query->first();
                if(!empty($query)){
                    $query->delete();
                }
            }
        }
        return redirect()->back()->with('success', __('Updated success!'));
    }
    public function terms(Request $request, $attr_id)
    {
        $this->checkPermission('job_manage_categories');
        $row = $this->categoriesClass::find($attr_id);
        if (empty($row)) {
            return redirect()->back()->with('error', __('Term not found'));
        }
        $listTerms = $this->termsClass::where("attr_id", $attr_id);
        if (!empty($search = $request->query('s'))) {
            $listTerms->where('name', 'LIKE', '%' . $search . '%');
        }
        $listTerms->orderBy('created_at', 'desc');
        $data = [
            'rows'        => $listTerms->paginate(20),
            'attr'        => $row,
            "row"         => new $this->termsClass(),
            'translation'    => new TermsTranslation(),
            'breadcrumbs' => [
                [
                    'name' => __('Job'),
                    'url'  => 'admin/module/Job'
                ],
                [
                    'name' => __('Room Categories'),
                    'url'  => 'admin/module/job/room/category'
                ],
                [
                    'name'  => __('Category: :name', ['name' => $row->name]),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Job::admin.terms.index', $data);
    }
    public function term_edit(Request $request, $id)
    {
        $this->checkPermission('job_manage_categories');
        $row = $this->termsClass::find($id);
        if (empty($row)) {
            return redirect()->back()->with('error', __('Term not found'));
        }
        $translation = $row->translateOrOrigin($request->query('lang'));
        $attr = $this->categoriesClass::find($row->attr_id);
        $data = [
            'row'         => $row,
            'translation'    => $translation,
            'enable_multi_lang'=>true,
            'breadcrumbs' => [
                [
                    'name' => __('Job'),
                    'url'  => 'admin/module/Job'
                ],
                [
                    'name' => __('Room Categories'),
                    'url'  => 'admin/module/job/room/category'
                ],
                [
                    'name' => $attr->name,
                    'url'  => 'admin/module/job/room/category/terms/' . $row->attr_id
                ],
                [
                    'name'  => __('Term: :name', ['name' => $row->name]),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Job::admin.terms.detail', $data);
    }
    public function term_store(Request $request)
    {
        $this->checkPermission('job_manage_categories');
        $this->validate($request, [
            'name' => 'required'
        ]);
        $id = $request->input('id');
        if ($id) {
            $row = $this->termsClass::find($id);
            if (empty($row)) {
                return redirect()->back()->with('error', __('Term not found'));
            }
        } else {
            $row = new $this->termsClass($request->input());
            $row->attr_id = $request->input('attr_id');
        }
        $row->fill($request->input());
        $row->image_id = $request->input('image_id');
        $row->icon = $request->input('icon');
        $res = $row->saveOriginOrTranslation($request->input('lang'));
        if ($res) {
            return redirect()->back()->with('success', __('Term saved'));
        }
    }
    public function editTermBulk(Request $request)
    {
        $this->checkPermission('job_manage_categories');
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('Select at least 1 item!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Select an Action!'));
        }
        if ($action == "delete") {
            foreach ($ids as $id) {
                $query = $this->termsClass::where("id", $id);
                $query->first();
                if(!empty($query)){
                    $query->delete();
                }
            }
        }
        return redirect()->back()->with('success', __('Updated success!'));
    }
    public function getForSelect2(Request $request)
    {
        $pre_selected = $request->query('pre_selected');
        $selected = $request->query('selected');
        if($pre_selected && $selected){
            if(is_array($selected))
            {
                $query = $this->termsClass::getForSelect2Query('job_room');
                $items = $query->whereIn('bravo_terms.id',$selected)->take(50)->get();
                return response()->json([
                    'items'=>$items
                ]);
            }
            if(empty($item)){
                return response()->json([
                    'text'=>''
                ]);
            }else{
                return response()->json([
                    'text'=>$item->name
                ]);
            }
        }
        $q = $request->query('q');
        $query = $this->termsClass::getForSelect2Query('job_room',$q);
        $res = $query->orderBy('bravo_terms.id', 'desc')->limit(20)->get();
        return response()->json([
            'results' => $res
        ]);
    }
}
