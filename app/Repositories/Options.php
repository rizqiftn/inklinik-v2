<?php

namespace App\Repositories;
use Illuminate\Support\Facades\DB;
use App\Repositories\Admission;
use Illuminate\Support\Str;
use Request;

class Options {

    public static function getProvince($id = null)
    {
        $options = [];
        $query = DB::table('province_m')->select('province_id', 'province_name'); 
        if ( !empty($id) ) {
            $query->where('province_id', '=', $id);
        }
        $data = $query->get()->toArray();

        if ( empty($data) ) {
            return $options;
        }
        
        foreach( $data as $key => $item ) {
            $options[] = [
                'id' => $item->province_id,
                'text' => $item->province_name,
            ];
        }
        return $options;
    }

    public static function getCity($id = null, $province_id = null)
    {
        $options = [];
        $query = DB::table('city_m')->select('city_id', 'city_name'); 
        if ( !empty($id) ) {
            $query->where('city', '=', $id);
        }
        if ( !empty($province_id) ) {
            $query->where('province_id', '=', $province_id);
        }
        $data = $query->get()->toArray();

        if ( empty($data) ) {
            return $options;
        }
        
        foreach( $data as $key => $item ) {
            $options[] = [
                'id' => $item->city_id,
                'text' => $item->city_name,
            ];
        }

        return $options;
    }

    public static function getDistrict($id = null, $city_id = null)
    {
        $options = [];
        $query = DB::table('district_m')->select('district_id', 'district_name'); 
        if ( !empty($id) ) {
            $query->where('district_id', '=', $id);
        }
        if ( !empty($city_id) ) {
            $query->where('city_id', '=', $city_id);
        }
        $data = $query->get()->toArray();

        if ( empty($data) ) {
            return $options;
        }
        
        foreach( $data as $key => $item ) {
            $options[] = [
                'id' => $item->district_id,
                'text' => $item->district_name,
            ];
        }

        return $options;
    }

    public function getSymptomList($symptom = null)
    {
        $options = [];
        $getData = (new Admission)->getSymptomList($symptom)->get(['symptoms'])->toArray();

        if ( !empty($getData) )
        {
            foreach( $getData as $key => $item ) {
                $options[] = [
                    'id' => $item->symptoms,
                    'text' => $item->symptoms,
                ];
            }
        } else {
            if ( $symptom ) {
                $options[] = [
                    'id' => $symptom,
                    'text' => $symptom
                ];
            }
        }

        return $options;
    }

    public function getDoctorList($doctorId = null) {
        $options = [];

        $getData = (new Doctor)->getAllDoctors();
        
        if ( !empty($getData) )
        {
            foreach( $getData as $key => $item ) {
                $options[] = [
                    'id' => $item->doctor_id,
                    'text' => $item->staff_name,
                ];
            }
        }

        return $options;
    }

    public function getDiagnoseList($diagnosaQuery = '')
    {
        $options = [];

        $getData = (new Diagnose)->getDiagnoseList($diagnosaQuery);
        
        if ( !empty($getData) )
        {
            foreach( $getData as $key => $item ) {
                $options[] = [
                    'id' => $item->diagnosa_id,
                    'text' => $item->diagnosa_kode . '-'. $item->diagnosa_nama,
                ];
            }
        }

        return $options;
    }

    public function getInstructionList($instructionQuery = '')
    {
        $options = [];

        $getData = (new Instruction)->getInstruction($instructionQuery);
        
        if ( !empty($getData) )
        {
            foreach( $getData as $key => $item ) {
                $options[] = [
                    'id' => $item->instruction_id,
                    'text' => $item->instruction_name,
                    'instruction' => $item
                ];
            }
        }

        return $options;
    }

    public function getMedicineList($medicineQuery = '')
    {
        $options = [];

        $getData = (new Medicine)->getMedicine($medicineQuery);
        
        if ( !empty($getData) )
        {
            foreach( $getData as $key => $item ) {
                $options[] = [
                    'id' => $item->medicine_id,
                    'text' => $item->medicine_name,
                    'medicine' => $item
                ];
            }
        }

        return $options;
    }
}