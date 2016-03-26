<?php
  require 'db_functions.php';
  require 'helpers.php';

  if (isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    switch($action) {
      case "get_comments":
        if (isset($_POST['artID'])) {
          get_comments();
        }
        break;
      case "submit_comment":
        if (isset($_POST['user_handle']) && isset($_POST['comment']) &&
            isset($_POST['artID'])) {
          submit_comment();
        }
        break;
      case "get_articles_by_tag":
        if (isset($_POST['tag'])) {
          get_articles_by_tag();
        }
        break;
      case "get_articles_by_recency":
        get_articles_by_recency();
        break;
      case "get_articles_by_author":
        if (isset($_POST['author'])) {
          get_articles_by_author();
        }
        break;
      default:
        echo "Action not found";
    }
  }

  function get_comments() {
    $query = "SELECT Commenter, Time, Content
              FROM comment
              WHERE comment.ArticleID = ?";
    $args = array($_POST['artID']);
    $result = $run_query($query, 's', $args);
    if (is_array($result) && count($result) > 0) {
      echo json_encode($result);
    } else {
      echo 0;
    }
  }

  function submit_comment() {
    $currTime = get_current_time();
    $commentNum = get_max_commentID() + 1;
    $query = "INSERT INTO comment (Commenter, Content, ArticleID, CommentID, TIME)
              VALUES (?, ?, ?, ?, ?)";
    $args = array($_POST['user_handle'], $_POST['comment'], $_POST['artID'],
                  $commentNum, $currTime);
    $result = execute_change($query, 'sssss', $args);
    if (!is_string($result)) {
      echo 1;
    } else {
      echo data;
    }
  }

  function get_articles_by_tag() {
    $query = "SELECT ArticleID, Author, ArticleName, PublishDate
              FROM article
              WHERE ArticleID
              IN (SELECT ArticleID FROM tag
                  WHERE tag = ?)
              ORDER BY PublishDate DESC";
    $args = array($_POST['tag']);
    $result = $run_query($query, 's', $args);
    if (is_array($result) && count($result) > 0) {
      echo json_encode($result);
    } else {
      echo 0;
    }
  }

  function get_articles_by_recency() {
    $query = "SELECT ArticleID, Author, ArticleName, PublishDate
              FROM article
              ORDER BY PublishDate DESC";
    $args = array();
    $result = $run_query($query, '', $args);
    if (is_array($result) && count($result) > 0) {
      echo json_encode($result);
    } else {
      echo 0;
    }
  }

  function get_articles_by_author() {
    $query = "SELECT ArticleID, Author, ArticleName, PublishDate
              FROM article
              WHERE Author = ?
              ORDER BY PublishDate DESC";
    $args = array($_POST('author'));
    $result = $run_query($query, 's', $args);
    if (is_array($result) && count($result) > 0) {
      echo json_encode($result);
    } else {
      echo 0;
    }
  }

?>
