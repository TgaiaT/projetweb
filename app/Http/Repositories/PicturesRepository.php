<?php
/**
 * Created by PhpStorm.
 * User: Nathan
 * Date: 24/01/2019
 * Time: 15:18
 */

namespace App\Http\Repositories;
use ZipArchive;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

class PicturesRepository
{
    /*
     * Get all the pictures.
     */
    public static function getPictures($id)
    {
        $client = ApiRepository::getClient();
        try
        {
            $url = "pictures" . ((isset($id)) ? "/" . $id : "" ) ."?precision=max";
            $pictures = json_decode((($client->request('GET', $url))->getBody()), true)["result"];
            //Layout pictures.
            return PicturesRepository::filterPictures($pictures);

        }catch (ConnectException | ClientException $e)
        {
            return null;
        }
    }

    /*
     * Layout the pictures in an pictures array.
     */
    private static function filterPictures($pictures)
    {
        $filteredPictures =  [];
        foreach ($pictures as $picture)
        {
            $filteredPictures[$picture["pictures:id_picture"]]["id"] = $picture["pictures:id_picture"];
            $filteredPictures[$picture["pictures:id_picture"]]["url"] = $picture["pictures:picture_url"];
            $filteredPictures[$picture["pictures:id_picture"]]["state"] = $picture["states:state"];
        }
        $filteredPictures = PicturesRepository::getComments($filteredPictures);
        $filteredPictures = PicturesRepository::getLiked($filteredPictures);
        return $filteredPictures;
    }

    /*
     * Get comments of pictures.
     */
    private static function getComments($pictures)
    {
        $client = ApiRepository::getClient();
        $filteredPictures = [];
        foreach ($pictures as $picture)
        {
            $url = "pictures/" . $picture["id"] . "?precision=max&getComments=true";
            $comments = json_decode((($client->request('GET', $url))->getBody()), true)["result"];
            $picture["comments"] = [];
            foreach ($comments as $comment)
            {
                $picture["comments"][$comment["comments:id_comment"]]["id"] = $comment["comments:id_comment"];
                $picture["comments"][$comment["comments:id_comment"]]["comment"] = $comment["comments:comment"];
                $picture["comments"][$comment["comments:id_comment"]]["id_user"] = $comment["comments:id_user"];
                $picture["comments"][$comment["comments:id_comment"]]["user_name"] = $comment["users:name"];
                $picture["comments"][$comment["comments:id_comment"]]["user_lastname"] = $comment["users:lastname"];
                $picture["comments"][$comment["comments:id_comment"]]["id_state"] = $comment["comments:id_state"];
            }
            array_push($filteredPictures, $picture);
        }
        return $filteredPictures;
    }

    /*
     * Get likes of pictures.
     */
    private static function getLiked($pictures)
    {
        $client = ApiRepository::getClient();
        $filteredPictures = [];
        foreach ($pictures as $picture)
        {
            $url = "pictures/" . $picture["id"] . "?precision=max&getLiked=true";
            $liked = json_decode((($client->request('GET', $url))->getBody()), true)["result"];
            $picture["liked"] = [];
            foreach ($liked as $like)
            {
                array_push($picture["liked"], $like["liked:id_user"]);
            }
            array_push($filteredPictures, $picture);
        }
        return $filteredPictures;
    }

    /*
     * Ban or forgive a picture.
     */
    public static function ban($id_picture, $ban)
    {
        $client = ApiRepository::getClient();
        try
        {
            $url = "pictures/" . $id_picture;
            /*
             * Ban a picture.
             */
            if ($ban)
            {
                $res = json_decode((($client->request('PUT', $url, [
                    "json" => [
                        "values" => [
                            "id_state" => 2
                        ]
                    ]
                ]))->getBody()), true);
            }
            /*
             * Forgive a picture.
             */
            else
            {
                $res = json_decode((($client->request('PUT', $url, [
                    "json" => [
                        "values" => [
                            "id_state" => 3
                        ]
                    ]
                ]))->getBody()), true);
            }

            if (!isset($res["error"]))
            {
                return false;
            }
            else
            {
                return $res["error"];
            }
        }catch (ConnectException | ClientException $e)
        {
            return true;
        }
    }

    /*
     * Zip all the events pictures and download it.
     */
    public static function zipImages()
    {
        $time = time();
        $url = "/var/www/yourdev/laravel/public/images/zips/";
        $rootPath = realpath('/var/www/yourdev/laravel/public/images/events');
        $filename = "zippedAt=" . $time . ".zip";

        // Initialize archive object
        $zip = new ZipArchive();
        $zip->open($url . $filename, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        // Create recursive directory iterator
        /** @var SplFileInfo[] $files */
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($rootPath),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file)
        {
            // Skip directories (they would be added automatically)
            if (!$file->isDir())
            {
                // Get real and relative path for current file
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);

                // Add current file to archive
                $zip->addFile($filePath, $relativePath);
            }
        }
        $zip->close();

        return $filename;
    }
}
