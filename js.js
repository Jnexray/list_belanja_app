  document.addEventListener("DOMContentLoaded", () => {
      loadItems();
    });

    function loadItems() {
      fetch('data.json')
        .then(response => response.json())
        .then(data => {
          const list = document.getElementById('shoppingList');
          list.innerHTML = ''; // clear existing

          data.forEach(item => {
            const li = document.createElement('li');
            li.className = 'list-group-item d-flex justify-content-between align-items-center';
            li.innerHTML = `
              ${item}
              <button class="btn btn-sm btn-danger" onclick="removeItem(this)">Hapus</button>
            `;
            list.appendChild(li);
          });
        });
    }

// addItem()  Mengambil isi dari input teks dan Jika kosong, fungsi berhenti
  
    function addItem() {
      const input = document.getElementById('itemInput');
      const itemText = input.value.trim();
      if (itemText === '') return;
  //Jika input valid, membuat elemen baru dan  Menambahkan ke daftar
      const list = document.getElementById('shoppingList');
      const li = document.createElement('li');
      li.className = 'list-group-item d-flex justify-content-between align-items-center';
      li.innerHTML = `${itemText} <button class="btn btn-sm btn-danger" onclick="removeItem(this)">Hapus</button>`;
      list.appendChild(li);
      input.value = '';
    }
//Menghapus elemen dari DOM ketika tombol "Hapus" ditekan
    function removeItem(button) {
      button.parentElement.remove();
    }