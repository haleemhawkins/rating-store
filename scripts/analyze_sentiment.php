/* 
   This is for testing sentiment analyzer through terminal.
   Example command: 
      php scripts/analyze_sentiment.php "I really love this shirt!"
         expected output = 3

   This uses the library otifsolutions/php-sentiment-analysis.
   More documentation can be found at: 
   https://github.com/otifsolutions/php-sentiment-analysis

*/  

<?php

require_once __DIR__ . '/../vendor/autoload.php';

use OTIFSolutions\PhpSentimentAnalysis\Sentiment;

// Create an instance of the Analyzer
$sentiment = new Sentiment();

// Get a comment from the command line arguments, if provided
$comment = $argv[1] ?? "This is a default test comment to analyze sentiment.";

// Analyze the sentiment of the comment
$result = $sentiment->analyze($comment);

// Output the result
echo "Sentiment analysis result:\n";
print_r($result['score']);

?>