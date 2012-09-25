<?php

/**
 * Api calls for getting data about songs.
 *
 * @link      http://developer.echonest.com/docs/v4/song.html
 * @author    Brent Shaffer <bshafs at gmail dot com>
 * @license   MIT License
 */
class EchoNest_Api_Song extends EchoNest_Api
{
  /**
   * Search for songs given different query types
   * http://developer.echonest.com/docs/v4/song.html#search
   *
   * @param   array $options          see the EchoNest documentation for a list of options
   * @return  array                   list of search results
   */
  public function search($options)
  {
    $response = $this->client->get('song/search', $options);

    return $this->returnResponse($response, 'songs');
  }

  /**
   * Get info about songs given a list of ids
   * http://developer.echonest.com/docs/v4/song.html#profile
   *
   * @param   array $id               the rosetta ID of the song (can be an array of ids) or can be The Echo Nest or Rosetta ID of a track specified by the track_id  
   * @param   string|array $bucket    indicates what data should be returned with each artist
   * @param   bool    $limit          if true artists will be limited to those that appear in the catalog specified by the id: bucket
   * @return  array                   list of search results
   */
  public function profile($id, $bucket = null, $limit = false)
  {
    $options = array_merge(array(
      'bucket' => $bucket,
      'limit'  => $limit,
    ),$id);

    $response = $this->client->get('song/profile', $options);

    return $this->returnResponse($response, 'songs');
  }
  /**
   * Identifies a song given Echo Nest Musical Fingerpint hash codes.
   * http://developer.echonest.com/docs/v4/song.html#indentify
   *
   * @param   array $options          see the EchoNest documentation for a list of options
   * @return  array                   list of search results
   */
  public function identify($options)
  {
    if (isset($options['query'])) {
      $response = $this->client->post('song/identify', $options);
    }
    else {
      $response = $this->client->get('song/identify', $options);
    }

    return $this->returnResponse($response, 'songs');
  }
}
