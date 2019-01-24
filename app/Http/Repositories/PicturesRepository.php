<?php
/**
 * Created by PhpStorm.
 * User: Nathan
 * Date: 24/01/2019
 * Time: 15:18
 */

namespace App\Http\Repositories;


class PicturesRepository
{
    public static function getPictures($id)
    {
        $client = ApiRepository::getClient();
        try
        {
            $url = "pictures" . ((isset($id)) ? "/" . $id : "" ) ."?precision=max";
            $pictures = json_decode((($client->request('GET', $url))->getBody()), true)["result"];
            return PicturesRepository::filterPictures($pictures); //TODO

        }catch (ConnectException | ClientException $e)
        {
            return null;
        }
    }

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
                $picture["comments"][$comment["comments:id_comment"]]["id_state"] = $comment["comments:id_state"];
            }
            array_push($filteredPictures, $picture);
        }
        return $filteredPictures;
    }

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
}
