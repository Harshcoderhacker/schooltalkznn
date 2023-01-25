<?php

namespace App\Http\Livewire\Admin\Material;

use App\Models\Admin\Material\Material;
use App\Models\Admin\Material\Materiallist;
use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Subject;
use App\Models\Parent\Parenthelper\Parenthelper;
use DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Log;

class Materialindexlivewire extends Component
{
    use WithFileUploads, WithPagination;

    public $platform, $classmaster;
    public $classmaster_id = 1;
    public $materialselected = false;
    public $createmodal = false;
    public $createclassmasterlist;
    public $material_type, $subjectlist;
    public $seclectedmaterlistid;

    public $searchTerm, $paginationlength = 10;
    public $deletemodal = false;

    public $title, $creatematerial_type, $createclassmaster_id, $subject_id, $document;
    public $description;

    public $user;

    public function mount($platform)
    {
        if ($platform == "admin") {
            $this->platform = $platform;
            $classmaster = Classmaster::where('active', true)->get();
            $this->subjectlist = Subject::where('active', true)->get();
            $this->user = auth()->user();
            $this->classmaster = $classmaster;
            $this->createclassmasterlist = $classmaster;
        } elseif ($platform == "staff") {
            $this->user = auth()->guard('staff')->user();
            $this->platform = $platform;
            $classmaster = Assignsubject::where('staff_id', $this->user->id)
                ->get()
                ->unique('classmaster_id');
            $this->subjectlist = Assignsubject::where('staff_id', $this->user->id)
                ->get()
                ->unique('subject_id');
            $this->classmaster = $classmaster;
            $this->createclassmasterlist = $classmaster;
        } elseif ($platform == "student") {
            $this->platform = $platform;
            $this->user = Parenthelper::getstudentweb();
            $this->classmaster_id = $this->user->classmaster_id;
        }
        $this->material_type = 1;
    }

    protected function rules()
    {
        return [
            'title' => 'required|min:3|max:20',
            'creatematerial_type' => 'required|integer',
            'createclassmaster_id' => 'required|integer',
            'document' => 'required|mimes:doc,docx,pdf,jpg,png,ppt|max:10240',
            'description' => 'nullable',
        ];
    }

    protected $messages = [
        'title.required' => 'Title cannot be empty',
        'creatematerial_type.required' => 'Material Type cannot be empty',
        'creatematerial_type.integer' => 'Material Type cannot be empty',
        'createclassmaster_id.required' => 'Class cannot be empty',
        'createclassmaster_id.integer' => 'Class cannot be empty',
    ];

    public function changematerialtype($material_type)
    {
        $this->materialselected = false;
        $this->material_type = $material_type;
    }

    public function updatedClassmasterid()
    {
        $this->materialselected = false;
    }

    public function backfrommateriallist()
    {
        $this->materialselected = false;
    }

    public function selecthisdoc($material)
    {
        $this->materialselected = true;
        $this->seclectedmaterlistid = $material;
    }

    public function uploadmaterial()
    {
        $this->createmodal = true;
    }

    public function closecreatemodal()
    {
        $this->createmodal = false;
    }

    public function createmateriallist()
    {
        $this->validate();
        if ($this->creatematerial_type != 3) {
            $this->validate([
                'subject_id' => 'required|integer',
            ], [
                'subject_id.required' => 'Subject is required',
                'subject_id.integer' => 'Subject is required',
            ]);
        }

        try {
            DB::beginTransaction();

            if ($this->subject_id) {
                $material_id = Material::where('material_type', $this->creatematerial_type)
                    ->where('classmaster_id', $this->createclassmaster_id)
                    ->where('subject_id', $this->subject_id)
                    ->first()
                    ->id;
            } else {
                $material_id = Material::where('material_type', $this->creatematerial_type)
                    ->where('classmaster_id', $this->createclassmaster_id)
                    ->first()
                    ->id;
            }

            $payload = [
                'title' => $this->title,
                'material_id' => $material_id,
                'createclassmaster_id' => $this->createclassmaster_id,
                'subject_id' => $this->subject_id,
                'description' => $this->description,
                'document' => $this->savedocument(),
                'document_type' => $this->document->getClientOriginalExtension(),
            ];

            $this->user
                ->materiallist()
                ->save(new Materiallist($payload));

            DB::commit();

            $this->formreset();
            $this->resetPage();
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Material Added Successfully!']);
            $this->createmodal = false;

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }
    }

    public function formreset()
    {
        $this->title = null;
        $this->creatematerial_type = null;
        $this->createclassmaster_id = null;
        $this->description = null;
        $this->document = null;
        $this->subject_id = null;
    }

    public function downloadmaterial(Materiallist $materiallistid)
    {
        return Storage::download($materiallistid->document);
    }

    public function updatepagination()
    {
        $this->resetPage();
    }

    public function deletethismateriallist()
    {
        try {
            DB::beginTransaction();

            Materiallist::find($this->deletematerid)
                ->delete();

            DB::commit();
            $this->deletemodal = false;
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Material Deleted Successfully!']);

        } catch (Exception $e) {
            $this->exceptionerror('delete', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('delete', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('delete', 'three', $e);
        }
    }

    public function deleteconfirmation($materiallistid)
    {
        $this->deletematerid = $materiallistid;
        $this->deletemodal = true;
    }

    public function closedeletemodal()
    {
        $this->deletematerid = null;
        $this->deletemodal = false;
    }

    public function render()
    {
        if ($this->materialselected) {
            $materilist = Materiallist::where('material_id', $this->seclectedmaterlistid)
                ->where('title', 'like', '%' . $this->searchTerm . '%')
                ->where('active', true)
                ->latest()
                ->paginate($this->paginationlength)->onEachSide(1);
        } else {
            $materilist = [];
        }

        $materials = Material::where('active', true)
            ->where('classmaster_id', $this->classmaster_id)
            ->where('material_type', $this->material_type)
            ->get();

        return view('livewire.admin.material.materialindexlivewire', compact('materials', 'materilist'));
    }

    protected function savedocument()
    {
        return $this->document
            ->storeAs('material/documents/', time() . '.' . $this->document->getClientOriginalExtension());
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': material_section_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
