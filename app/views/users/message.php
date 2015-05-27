{% extends "layout/main.php" %}

{% block title %} Send Message - {% endblock %}

{% block main %}
  <h2>Account Page</h2>

  <div class="col-md-6">
    <form action="{{ HTTP_ROOT }}users/send" method="post">
      <div class="form-control">
        <label for="name">Your name: </label>
        <input type="text" name="name">
      </div>
      <br>
      <div class="form-control">
        <label for="email">Your email adress: </label>
        <input type="email" name="email">
      </div>
      <br>
      <label for="message">Your message: </label>
      <textarea name="message"></textarea>
      <br>
      <input type="submit" name="submit" value="Send">    
    </form>
  </div>
{% endblock %}
