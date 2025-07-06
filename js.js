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

    function addItem() {
      const input = document.getElementById('itemInput');
      const itemText = input.value.trim();
      if (itemText === '') return;

      const list = document.getElementById('shoppingList');
      const li = document.createElement('li');
      li.className = 'list-group-item d-flex justify-content-between align-items-center';
      li.innerHTML = `${itemText} <button class="btn btn-sm btn-danger" onclick="removeItem(this)">Hapus</button>`;
      list.appendChild(li);
      input.value = '';
    }

    function removeItem(button) {
      button.parentElement.remove();
    }