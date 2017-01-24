<?php
class Answer{
	private $db = '';
	public $question_id = '';
  public $answer = '';
  public $group_id = '';

	public function __construct($db) {
		$this->db = $db;
	}

	/**
	 * Writes the answer in the database.
	 */
	public function answer($question_id, $answer, $group_id) {
    $this->question_id = $question_id;
    $this->answer = $answer;
    $this->group_id = $group_id;

    $question = 'answer_' . $this->question_id;

    $sql = $this->db->prepare("UPDATE `groups`
      SET `$question` = :answer
      WHERE `id` = :id");
    $sql->execute(array(
      "answer" => $this->answer,
      "id" => $this->group_id
    ));

    return true;
	}

  public function finish($group_id) {
    $this->group_id = $group_id;

    $date = new DateTime();

    $sql = $this->db->prepare("UPDATE `groups`
      SET `finish_time` = :finish_time
      WHERE `id` = :id");
    $sql->execute(array(
      "finish_time" => $date->getTimestamp(),
      "id" => $this->group_id
    ));

    return true;
  }
}
