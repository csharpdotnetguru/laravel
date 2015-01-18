<?php

/**
 * An Eloquent Model: 'Review'
 *
 * @property integer $id
 * @property string $url
 * @property string $author
 * @property string $snippet
 * @property string $domain
 * @property string $image
 * @property string $blog_name
 * @property \Carbon\Carbon $lastmodified
 */
class ReviewUser extends Eloquent{
	protected $table = 'review_users';
}