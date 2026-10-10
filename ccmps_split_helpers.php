<?php
/*----------------------------------------------------------------------------*/
/*----------------- CCMPS / CCMPS_AUX SPLIT-MERGE HELPERS ---------------------*/
/*----------------------------------------------------------------------------*/
/*
  These two functions are the single source of truth for which fields live in
  `ccmps` vs `ccmps_aux`. If a column ever moves between the two tables, this
  is the only place that needs updating - every other function that calls
  _split_ccmp_data() or _merge_ccmp_row() stays correct automatically.
*/

/*----------------------------------------------------------------------------*/
/*----------------------- function _CCMPS_AUX_FIELDS --------------------------*/
/*----------------------------------------------------------------------------*/

function _ccmps_aux_fields() {
    // The 60 data columns that live in ccmps_aux (excludes id and ccmp_id,
    // which are handled separately since they're not "data" fields).
    return [
        'unverified', 'mfontsize', 'member_no', 'member_type', 'chapter',
        'chapter_role', 'content_mgr', 'chapter_admin', 'member_admin',
        'event_admin', 'old_participant_id', 'salutation', 'hall_of_fame',
        'call_sign', 'total_time', 'highest_certificate', 'certificate_number',
        'military_pilot', 'private', 'commercial', 'atp', 'cfi', 'cfii', 'mei',
        'dpe', 'bgi', 'agi', 'dispatcher', 'other_crewmember', 'ocm_certnum',
        'other_faa_cert', 'ofc_certnum', 'special_event', 'no_address',
        'maintenance', 'se_land', 'me_land', 'se_sea', 'me_sea', 'instrument',
        'rotocraft', 'glider', 'balloon', 'drone', 'ap', 'ap_number', 'ia',
        'military_maint', 'airship', 'atc', 'cred_notes', 'aircraft_owner',
        'aircraft_type', 'aircraft_mmhp', 'aircraft_reg', 'url_string',
        'confirmed', 'homepage', 'deleted', 'skyhook',
    ];
}

/*----------------------------------------------------------------------------*/
/*------------------------ function _SPLIT_CCMP_DATA --------------------------*/
/*----------------------------------------------------------------------------*/

/**
 * Splits a flat associative array (e.g. built from $_POST, or from
 * _ccmps_fetch_data_from_post()) into the two arrays needed to update/insert
 * into ccmps and ccmps_aux separately.
 *
 * @param array $posted_data  Flat array of field_name => value
 * @return array ['core' => [...], 'aux' => [...]]
 */
function _split_ccmp_data($posted_data) {

    $aux_field_names = _ccmps_aux_fields();
    $aux_field_lookup = array_flip($aux_field_names); // for O(1) isset() checks

    $core = [];
    $aux  = [];

    foreach ($posted_data as $field => $value) {
        if (isset($aux_field_lookup[$field])) {
            $aux[$field] = $value;
        } else {
            // Anything not explicitly an aux field goes to core.
            // This includes id, code, status, all the ccmps.sql columns, etc.
            $core[$field] = $value;
        }
    }

    return ['core' => $core, 'aux' => $aux];
}

/*----------------------------------------------------------------------------*/
/*------------------------ function _MERGE_CCMP_ROW ----------------------------*/
/*----------------------------------------------------------------------------*/

/**
 * Flattens an aux row's fields directly onto the core row object, matching
 * how every existing view file expects to read fields (e.g. $row->chapter,
 * $row->member_no) - NOT nested like $row->auxdata->chapter.
 *
 * Mirrors the pattern used for addresses, EXCEPT addresses are intentionally
 * kept as a nested sub-object ($ccmp_data->mailaddrdata->address1) because
 * views reference them that way. Aux fields must NOT be nested the same way,
 * since every view references them flat.
 *
 * @param object $core_row  Result of $this->model->get_where($id, 'ccmps')
 * @param object|false $aux_row  Result of $this->model->get_one_where('ccmp_id', $id, 'ccmps_aux')
 * @return object  The core row with all aux fields flattened onto it
 */
function _merge_ccmp_row($core_row, $aux_row) {

    if ($aux_row === false || $aux_row === null) {
        // No aux row found (shouldn't normally happen post-migration, but
        // don't fatal - just skip merging so the caller still gets the core
        // fields back).
        return $core_row;
    }

    $aux_field_names = _ccmps_aux_fields();

    foreach ($aux_field_names as $field) {
        if (property_exists($aux_row, $field)) {
            $core_row->$field = $aux_row->$field;
        }
    }

    return $core_row;
}
