<?php

class EloquentPackageRepository implements PackageRepositoryInterface {

	public function find_package_by_uniq_id($pkg_uniq_id)
	{
		return Package::where('pkg_uniq_id', '=', $pkg_uniq_id)->get()->first();
	}

}