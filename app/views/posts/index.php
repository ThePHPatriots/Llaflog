{% extends "layout/main.php" %}

{% block title %}View All Posts – {% endblock %}

{% block main %}
<h2>Latest Blog Posts</h2>
{% if help.logged_in %}<small><a href="{{ HTTP_ROOT ~ 'posts/create' ~ post.id }}" class="btn btn-default btn-xs">Create a post</a></small>{% endif %}
<hr>

<ol>
{% for post in posts %}
  <li>
    <h3><a href="{{ HTTP_ROOT ~ 'posts/show/' ~ post.id }}">{{ post.title }}</a>
      {% if help.logged_in %}<small><a href="{{ HTTP_ROOT ~ 'posts/edit/' ~ post.id }}" class="btn btn-default btn-xs">Edit</a></small>{% endif %}
      {% if help.logged_in %}<small><a href="{{ HTTP_ROOT ~ 'posts/delete/' ~ post.id }}" class="btn btn-danger btn-xs">Delete</a></small><br>{% endif %}
      	<h6><p>Created at: {{post.created_at}}</p></h6><hr>
    </h3>
  </li>
{% endfor %}
</ol>
{% endblock %}
