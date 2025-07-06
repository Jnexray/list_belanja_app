<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar Belanja AJAX</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">
        <h4 class="mb-0">🛒 Daftar Belanja Interaktif </h4>
      </div>
      <div class="card-body">

        <!-- Form -->
        <div class="input-group mb-3">
          <input type="text" id="itemInput" class="form-control" placeholder="Masukkan item baru">
          <button class="btn btn-success" onclick="addItem()">Tambah</button>
        </div>

        <!-- Daftar belanja -->
        <ul class="list-group" id="shoppingList">
          <!-- Diisi via JavaScript -->
        </ul>

      </div>
    </div>
  </div>

  <!-- Script -->
  <script>
    // Muat data saat halaman dibuka
    document.addEventListener("DOMContentLoaded", loadItems);

    function loadItems() {
      fetch('action.php?action=list')
        .then(res => res.json())
        .then(data => {
          const list = document.getElementById('shoppingList');
          list.innerHTML = '';
          data.forEach((item, index) => {
            list.innerHTML += `
              <li class="list-group-item d-flex justify-content-between align-items-center">
                ${item}
                <button class="btn btn-sm btn-danger" onclick="deleteItem(${index})">Hapus</button>
              </li>`;
          });
        });
    }

    function addItem() {
      const input = document.getElementById('itemInput');
      const item = input.value.trim();
      if (item === '') return;

      fetch('action.php?action=add', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ item })
      })
      .then(res => res.json())
      .then(() => {
        input.value = '';
        loadItems(); // Refresh list
      });
    }

    function deleteItem(index) {
      fetch('action.php?action=delete', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ index })
      })
      .then(res => res.json())
      .then(() => {
        loadItems(); // Refresh list
      });
    }
  </script>
</body>
</html>
