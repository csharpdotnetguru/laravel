<?php 

class SessionCode extends Eloquent {

	protected $connection = 'unotelly_portal';
	
	protected $table = 'session_codes';

    // fillable fields (form)
    protected $fillable = ['session_code', 'uid'];

    // visible fields (json)
    protected $visible = ['session_code', 'uid'];

    // guarded fields (against mass assignment)
    protected $guarded = ['id'];





}
