<?php
require_once('lib/Phirehose.php');
/**
 * Example of using Phirehose to display a live filtered stream using geo locations 
 */
class FilterTrackConsumer extends Phirehose
{
  /**
   * Enqueue each status
   *
   * @param string $status
   */
  public function enqueueStatus($status)
  {
    /*
     * In this simple example, we will just display to STDOUT rather than enqueue.
     * NOTE: You should NOT be processing tweets at this point in a real application, instead they should be being
     *       enqueued and processed asyncronously from the collection process. 
     */
    $data = json_decode($status, true);
		//print $data;
		//geo":{"type":"Point","coordinates":[37.73389831,-122.38514871]},
    if (is_array($data) && isset($data['user']['screen_name'])&& isset($data['geo']['type'])) {
      if($data['geo']['type']=="Point") {
        //$result = $data['user']['screen_name'] . ': ' . urldecode($data['text']) .$data['geo']['coordinates'][0] . ': ' . $data['geo']['coordinates'][1] . "\n";
        
        $timestamp = $data['created_at'];
        $username = $data['user']['screen_name'];
        $text = $data['text'];
        $lat = $data['geo']['coordinates'][0];
        $lng = $data['geo']['coordinates'][1];
        
        
		//print $result;
		//header("Content-type: text/xml");
 
  // Start XML file, echo parent node
        $result = '<?xml version="1.0" encoding="ISO-8859-1"?>'."\n";
        $result = $result.'<markers>'."\n";
        $result = $result.'<marker time="'.$timestamp.'" lat="'.$lat.'" lng="'.$lng.'" username="'.$username.'" text="'.$text.'" />'."\n";
        $result = $result.'</markers>'."\n";

    // ADD TO XML DOCUMENT NODE
    //echo '<marker ';
    //echo 'time="' . $row['timestamp'] . '" ';
    //echo 'lat="' . $row['lat'] . '" ';
    //echo 'lng="' . $row['lng'] . '" ';
    //echo 'speed="' . $row['speed'] . '" ';
    //echo 'course="' . $row['course'] . '" ';
    //echo 'value="' . $row['value'] . '" ';
    //echo '/>';
    // End XML file
    //echo '</markers>';
        file_put_contents('result.xml', $result);
	    print $result;
      }
    }
  }
}

// Start streaming
$sc = new FilterTrackConsumer('yourusername', 'yourpassword', Phirehose::METHOD_FILTER);
$sc->setLocations(array(
       array(-122.75, 36.8, -121.75, 37.8), // San Francisco
   ));
$sc->consume();
