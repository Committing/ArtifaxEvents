# ArtifaxEvents
Class for grabbing Artifax Events

## Requires
1. Guzzle

## Usage

    // Load in Guzzle
    require 'vendor/autoload.php';

    // Load in the Artifax class
    require 'classes/artifax.class.php';


    $artifax = new Artifax( ARTIFAX_API_KEY, new \GuzzleHttp\Client() );

    $artifax->requestEventData(array(
        'public_status' => 1,
        'date' => 'between',
        'start_date' => date('Y-m-d', strtotime('-2 weeks')),
        'end_date' => date('Y-m-d', strtotime('+3 weeks'))
    ));


    if (200 === $artifax->getStatusCode()) {


        foreach ( $artifax->returnData() as $var ) {
    
            // Use data
    
        }
    
    }
