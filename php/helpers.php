<?php

function get_current_time() {
        return date('Y-m-d H:i:s', time());
    }

function get_max_commentID() {
            $query = "SELECT MAX(CommentID) from comment";
            $args = array();
            $results = run_query($query, '', $args);
            if (is_array($results) && count($results) == 1) {
                return $results[0][0];
            } else {
                return 0;
            }
        }

?>
