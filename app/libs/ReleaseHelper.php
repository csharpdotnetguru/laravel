<?php

/***
 * Class ReleaseHelper
 * Quick class to parse the content of composer.json and use it everywhere
 * Also serves as a helper class to get info such as Rocketeer release numbers.
 */
class ReleaseHelper {

    /***
     * Gets the current release number
     * @return bool|int
     */
    public static function getReleaseNumber() {
        $base_path = base_path();
        $number = basename($base_path);
        return (is_numeric($number)) ? $number : App::environment();
    }

    /***
     * @param $key
     * @return string|null
     */
    public static function getValueForKey($key)
    {
        $json = static::getComposerJson();
        return (isset($json->{$key})) ? $json->{$key} : null;
    }

    /***
     * Bumping composer package version
     * @param string $bump
     * @param bool $save
     * @return string|bool
     */
    public static function bumpVersion($bump = 'patch', $save = false)
    {
        $json = static::getComposerJson();
        $info = explode('.', $json->version);

        switch($bump) {
            case 'patch':
                $info[2]++;
                break;

            case 'minor':
                $info[1]++;
                break;

            case 'major':
                $info[0]++;
                break;
        }

        $bumped_version = implode('.', $info);

        if ($save) {
            $json->version = $bumped_version;
            if (static::saveComposerJson($json)) {
                return $bumped_version;
            } else {
                return false;
            }
        }

        return $bumped_version;
    }

    /***
     * @return json|null
     * @throws Exception
     */
    public static function getComposerJson()
    {
        $file = __DIR__ . '/../../composer.json';
        $content = file_get_contents($file);
        try {
            return json_decode($content);

        } catch (Exception $e) {
            if (App::environment('development'))
                throw($e);

            return null;
        }
    }

    /***
     * Rewrites the composer.json file
     * @param $obj
     * @return bool
     */
    public static function saveComposerJson($obj)
    {
        $file = __DIR__ . '/../../composer.json';
        $saved = file_put_contents($file, json_encode($obj, JSON_PRETTY_PRINT));
        return ($saved) ? true : false;
    }

}