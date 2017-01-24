<?php
require 'core/config.php';

/**
 * Reloads the page every 3 seconds.
 */
$url1=$_SERVER['REQUEST_URI'];
header("Refresh: 3; URL=$url1");

/******************************************************************************/

/**
 * Adds the HTML head.
 */
require DIR_VIEWS.'general/html-head.php';

/**
 * Adds the header of the app.
 */
require DIR_VIEWS.'general/header.php';

/******************************************************************************/



/**
 * Gets the live results.
 */
$sql = $db_connection->prepare("SELECT * FROM groups");
$sql->execute();
$results = $sql->fetchAll(PDO::FETCH_ASSOC);

/**
 * Calculates the results.
 */
$updated_results = '';
if(is_array($results)) {
  foreach($results as $id => $result) {
    $result['points'] = 0;

    for($i=1; $i <= ANSWERS_QTY; $i++) {
      if(constant('ANSWER_' . $i) === $result['answer_' . $i]) {
        $result['points'] = $result['points'] + ANSWER_POINTS;
      }
    }

    $updated_results[] = array(
      'name' => $result['name'],
      'points' => $result['points'],
      'finish_time' => $result['finish_time']
    );
  }
}

/**
 * Sorts the results.
 */
function scoreSort($a, $b){
  if ($a['points'] == $b['points']) {
   if ($a['finish_time'] > $b['finish_time']) return 1;
  }
  return $a['points'] < $b['points'] ? 1 : -1;
}
if($updated_results && is_array($updated_results)) {
  usort($updated_results, 'scoreSort');
}

/**
 * Takes the first x elements of the sorted results array.
 */
$final_results = array();
if(isset($updated_results) && is_array($updated_results)) {
    /**
     * Shows only the first 5 elements.
     */
    for($i = 0; $i < 5; $i++) {
        if(isset($updated_results[$i])) {
            $final_results[$i] = $updated_results[$i];
        }
    }
}
?>
<section>
	<div class="row">
		<div class="col-xs-12">
			<table class="table table-striped">
        <tr>
          <th>Platz</th>
          <th>Team</th>
          <th>Punkte</th>
        </tr>
        <?php
        if(is_array($final_results)) {
          $pos = 0;
          foreach($final_results as $result) {
            $pos = $pos + 1;
            ?>
            <tr>
              <td><?php echo $pos; ?></td>
              <td><?php echo $result['name']; ?></td>
              <td><?php echo $result['points']; ?></td>
            </tr>
            <?php
          }
        }
        ?>
      </table>
		</div><!-- /.col -->
	</div><!-- /.row -->
</section>
<?php
require DIR_VIEWS.'general/footer.php';
