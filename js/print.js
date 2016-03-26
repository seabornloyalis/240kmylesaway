function print_comments(comment_array) {
  comment_array = JSON.parse(comment_array);
  for (i = 0; i < comment_array.length; i++) {
    var comment = document.createElement("li");
    comment.setAttribute("class", "list-group-item");
    comment.setAttribute("id", "comment" + i);
    var userHandle = document.createElement("h4");
    userHandle.setAttribute("class", "list-group-item-heading");
    userHandle.innerHTML = comment_array[i][0];
    var timestamp = document.createElement("span");
    timestamp.setAttribute("class", "badge");
    timestamp.innerHTML = comment_array[i][1];
    var commment_text = document.createElement("p");
    commment_text.setAttribute("class", "list-group-item-text");
    commment_text.innerHTML = comment_array[i][2];

    comment.appendChild("userHandle");
    comment.appendChild("timestamp");
    comment.appendChild("commment_text");

    document.getElementById("comments").appendChild(comment);
  }
}
