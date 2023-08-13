<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class Reference {
    public static function getReferenceById( $referenceId )
    {
        if ( empty($referenceId) ) {
            return [];
        }

        if ( !is_array($referenceId) ) {
            $referenceId[] = $referenceId;
        }

        return DB::table('reference_m')->select()->where('reference_id', 'IN', $referenceId)->get();
    }

    public static function getReferenceByType( $referenceType )
    {
        if ( empty($referenceType) ) {
            return [];
        }

        if ( !is_array($referenceType) ) {
            $referenceType[] = $referenceType;
        }

        return DB::table('reference_m')->select()->where('reference_type', 'IN', $referenceType)->get();
    }
}