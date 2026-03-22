# announcements
The Chaos MVC Announcements Module
An announcements Addon Module for the Chaos MVC

# Install
1. Use `install/announcements.sql` to setup the announcements data table
2. Copy all of the contents in `app` to `app` of your Chaos MVC domain.
3. Log into your website and go to its `admin`
4. Click on announcements

Example Usage:
```php
<div class="row">
   <h2>Announcements</h2>
  <?php 
  // Announcements
  if(isset($data['featured_announcement']) && $data['featured_announcement'] !== false) : 
      $post = $data['featured_announcement']; 
  ?>

    <section id="latest-announcement">

      <div class="announcement-content">

        <h3><?= htmlspecialchars($post['title']); ?></h3>

        <p>
          <?= nl2br(htmlspecialchars($post['body'])); ?>
        </p>

        <small>
          Posted: <?= date('Y.m.d', strtotime($post['created_at'])); ?>
        </small>

      </div>

    </section>

  <?php endif; ?>

  </div>
  <hr>
  ```
  
  This will grab the latest announcement from the announcements table.
