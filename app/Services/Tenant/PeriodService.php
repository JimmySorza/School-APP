<?php


namespace App\Services\Tenant;


use App\Models\Tenant\Period;
use App\Models\Tenant\PeriodStudent;
use App\Repositories\Tenant\PeriodRepository;
use Facade\FlareClient\Http\Exceptions\InvalidData;
use Illuminate\Support\Arr;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PeriodService
{
    /**
     * @var PeriodRepository
     */
    private $repository;

    /**
     * PeriodService constructor.
     * @param PeriodRepository $repository
     */
    public function __construct(PeriodRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll($requestData)
    {
        $periods = $this->repository->getAll($requestData, isset($requestData['paginate']) ? $requestData['paginate'] : true);
        if ($periods->count()) {
            $allPeriods = collect($periods->all())->map->only([
                "id",
                "name",
                "room",
                "day",
                "time",
                "sitting_rows",
                "sitting_cols",
                "teachers_string",
                "no_of_students",
                "no_of_teachers",
                "no_of_administration",
            ]);

            $paginatedData = $periods->toArray();

            // case where data is not paginated
            if (isset($requestData['paginate']) && !$requestData['paginate']) {
                if (isset($requestData['fields'])) {
                    $fields = explode(',', $requestData['fields']);
                    $allPeriods = collect($periods->all())->map->only($fields);
                }
                return $allPeriods;
            }

            // case where data is paginated
            $paginatedData['data'] = $allPeriods;

            return $paginatedData;
        }

        return null;
    }

    public function get($id)
    {
        $period = $this->repository->getOne($id);
        if ($period) {
            $periodArray =  Arr::only($period->toArray(),[
                "id",
                "name",
                "room",
                "day",
                "time",
                "sitting_rows",
                "sitting_cols",
                "no_of_students",
                "no_of_teachers",
                "no_of_administration",
            ]);
            $periodArray["students"] = $period->students;
            $periodArray["teachers"] = $period->teachers;
            return $periodArray;
        }

        return null;
    }

    public function store($data)
    {

        $data["no_of_students"] = count($data['students']);
        $data["no_of_teachers"] = count($data['teachers']);
        $data["no_of_administration"] = count($data['administration']);

        $period = $this->repository->store($data);
        if ($period->no_of_students) {
            $period->students()->attach($data['students']);
        }
        if ($period->no_of_teachers) {
            $period->teachers()->attach($data['teachers']);
        }
        if ($period->no_of_administration) {
            $period->administrations()->attach($data['administration']);
        }
    }

    public function patch($data)
    {
        $id = $data['id'];
        $students = isset($data['students'])? $data['students']: null;
        $teachers = isset($data['teachers'])? $data['teachers']: null;
        $administration = isset($data['administration'])? $data['administration']: null;
        unset($data['id'],$data['students'],$data['teachers'],$data['administration']);
        $period = $this->repository->getOne($id);
        if (is_array($students)) {
            $data["no_of_students"] = count($students);
            $period->students()->detach();
            $period->save();
            $period->students()->attach($students);
        }
        if (is_array($teachers)) {
            $data["no_of_teachers"] = count($teachers);
            $period->teachers()->detach();
            $period->save();
            $period->teachers()->attach($teachers);
        }
        if (is_array($administration)) {
            $data["no_of_administration"] = count($administration);
            $period->administration()->detach();
            $period->save();
            $period->administration()->attach($administration);
        }
        return $this->repository->update($data, $id);
    }

    /**
     * @param $data
     * @return mixed
     * @throws InvalidData
     */
    public function storeUserMatrixLocation($data)
    {
        $periodStudent = PeriodStudent::where('period_id', $data['period_id'])->where('student_id', $data['student_id'])->first();
        $matrix_place_row = null;
        $matrix_place_col = null;

        if (!$periodStudent) {
            throw new NotFoundHttpException();
        }

        if ($data['matrix_place_row'] && $data['matrix_place_col']) {
            if ($this->isSelectedLocationValid($data)) {
                $matrix_place_row = $data['matrix_place_row'];
                $matrix_place_col = $data['matrix_place_col'];
            } else {
                throw new InvalidData('Invalid chart position.', 400);
            }
        }

        return PeriodStudent::where('period_id', $data['period_id'])
            ->where('student_id', $data['student_id'])
            ->update(['matrix_place_row' => $matrix_place_row, 'matrix_place_col' => $matrix_place_col]);
    }

    private function isSelectedLocationValid($data)
    {
        $preFilled = PeriodStudent::where('matrix_place_row', $data['matrix_place_row'])
            ->where('matrix_place_col', $data['matrix_place_col'])
            ->where('period_id', $data['period_id'])
            ->where('student_id', '!=', $data['student_id'])->count();
        $period = $this->repository->getOne($data['period_id']);
        $validRow = ($data['matrix_place_row'] <= $period->sitting_rows);
        $validCol = ($data['matrix_place_col'] <= $period->sitting_cols);
        return !$preFilled && $validRow && $validCol;
    }
}
