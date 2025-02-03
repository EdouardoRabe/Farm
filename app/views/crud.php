<head>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&family=Mukta:wght@300;400;600;700;800&family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="assets/css/crud.css">
 
  
  </head>
  
  <body>
  <?php if (!empty($list)) { ?>
      <table>
          <thead>
              <tr>
                  <?php foreach (array_keys($list[0]) as $header) { ?>
                      <?php if (!is_numeric($header)) { ?>
                          <th><?= htmlspecialchars($header) ?></th>
                      <?php } ?>
                  <?php } ?>
                  <th>Update</th>
                  <th>Delete</th>
              </tr>
          </thead>
          <tbody>
              <?php foreach ($list as $row) { ?>
                  <tr>
                      <?php foreach ($row as $key => $value) { ?>
                          <?php if (!is_numeric($key)) { ?>
                              <td><?= htmlspecialchars($value) ?></td>
                          <?php } ?>
                      <?php } ?>
                      <td>
                          <a href="<?= $redirectUpdate ?>?<?= $column ?>=<?= htmlspecialchars($row[$column]) ?>">
                              <p class="status status-unpaid">Update</p>
                          </a>
                      </td>
                      <td>
                          <a href="<?= $redirectDelete ?>?<?= $column ?>=<?= htmlspecialchars($row[$column]) ?>">
                              <p class="status status-delete">Delete</p>
                          </a>
                      </td>
                  </tr>
              <?php } ?>
          </tbody>
      </table>
  <?php } else { ?>
      <p>Aucune donnée disponible.</p>
  <?php } ?>


  </body>