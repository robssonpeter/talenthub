<?php

namespace App\Http\Livewire;

use App\Models\Candidate;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class CandidateSearch extends Component
{
    use WithPagination;

    public $searchByCandidate = '', $gender = '', $searchBy = 'byJobTitle', $location, $min, $max, $payCurrency, $functionalArea, $industry, $minYears;

    public function paginationView()
    {
        return 'livewire.custom-pagenation';
    }

    public function nextPage($lastPage)
    {
        if ($this->page < $lastPage) {
            $this->page = $this->page + 1;
        }
    }

    public function previousPage()
    {
        if ($this->page > 1) {
            $this->page = $this->page - 1;
        }
    }

    public function updatingSearchByCandidate()
    {
        $this->resetPage();
    }

    public function updatinglocation()
    {
        $this->resetPage();
    }

    public function updatingMin()
    {
        $this->resetPage();
    }

    public function updatingMax()
    {
        $this->resetPage();
    }

    public function render()
    {
        $candidates = $this->searchCandidates();

        return view('livewire.candidate-search', compact('candidates'));
    }

    /**
     * @param $param
     *
     * @param $value
     */
    public function changeFilter($param, $value)
    {
        $this->resetPage();
        $this->$param = $value;
    }

    public function resetFilter()
    {
        $this->location = '';
        $this->min = '';
        $this->max = '';
        $this->searchByCandidate = '';
        $this->searchBy = 'byJobTitle';
        $this->payCurrency = 0;

    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchCandidates()
    {
        /** @var Candidate $query */
        $query = Candidate::with(['user', 'jobApplications', 'experiences']);

        $query->when($this->searchByCandidate != '' && $this->searchBy == 'byName', function (Builder $q) {
            $q->whereHas('user', function (Builder $query) {
                $query->where('first_name', 'like', '%'.strtolower($this->searchByCandidate).'%');
            });
        });

        $query->when($this->searchByCandidate != '' && $this->searchBy == 'byJobTitle', function (Builder $q) {
            $q->whereHas('penddingJobApplications.job', function (Builder $query) {
                $query->where('jobs.job_title', 'like', '%'.strtolower($this->searchByCandidate).'%');
            });
        });

        $query->when($this->location != '', function (Builder $q) {
            $q->whereHas('user', function (Builder $query) {
                $query->WhereHas('country', function (Builder $q) {
                    $q->where('name', 'like', '%'.$this->location.'%');
                });
                $query->orWhereHas('state', function (Builder $q) {
                    $q->where('name', 'like', '%'.$this->location.'%');
                });
                $query->orWhereHas('city', function (Builder $q) {
                    $q->where('name', 'like', '%'.$this->location.'%');
                });
            });
        });

        $query->when($this->gender == 'all', function (Builder $q) {
            $q->whereHas('user', function (Builder $q) {
                $q->whereIn('gender', [0, 1]);
            });
        });

        $query->when($this->gender == 'male', function (Builder $q) {
            $q->whereHas('user', function (Builder $q) {
                $q->where('gender', '=', 0);
            });
        });

        $query->when($this->gender == 'female', function (Builder $q) {
            $q->whereHas('user', function (Builder $q) {
                $q->where('gender', '=', 1);
            });
        });

        $query->when(!empty($this->payCurrency), function(Builder $q){
            $q->where('salary_currency', '=', $this->payCurrency);
        });

        $query->when(! empty($this->min), function (Builder $q) {
            $q->where('expected_salary', '>', $this->min);
        });
        $query->when(! empty($this->max), function (Builder $q) {
            $q->where('expected_salary', '<', $this->max);
        });

        /*$query->when(!empty($this->industry), function(Builder $q){
            $q->whereHas('industry', function (Builder $query) {
                $query->where('id', $this->industry);
            });
        });*/

        $query->when(!empty($this->industry), function(Builder $q){
            $q->whereHas('experiences', function (Builder $query) {
                $query->where('industry_id', $this->industry);
            });
        });

        $query->when(!empty($this->functionalArea), function(Builder $q){
            $q->whereHas('experiences', function (Builder $query) {
                $query->where('functional_areas', 'LIKE', "%\"".$this->functionalArea."\"%");
            });
        });

        $query->when(!empty($this->minYears), function(Builder $q){
            $q->whereHas('experiences', function (Builder $query) {
                $years = (string) round($this->minYears);
                $days = ((integer) $years)*365;
                $ago = new Carbon($years." years ago");
                $dateAgo = $ago->format('Y-m-d');
                $query->where('start_date', '<=', $dateAgo)->where('currently_working', 1)->orWhereRaw('DATEDIFF(`start_date`, `end_date`) >= '.$days);
            });
        });

        return $query->paginate(10);
    }
}
