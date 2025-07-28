
        // Data Produk dalam JavaScript Array
        const products = [
            {
                id: 1,
                nama: "Celana Jogger Sporty",
                deskripsi: "Celana jogger nyaman untuk olahraga dan aktivitas sehari-hari.",
                harga: 185000,
                gambar: "img/Celana Jogger Sporty.jpg", // Ganti dengan URL gambar asli
                kategori: "Pakaian Gym"
            },
            {
                id: 2,
                nama: "Kaos Dry-Fit Ultimate",
                deskripsi: "Kaos dengan teknologi Dry-Fit yang cepat kering, cocok untuk lari.",
                harga: 95000,
                gambar: "img/Kaos Dry-Fit Ultimate.jpg", // Ganti dengan URL gambar asli
                kategori: "Pakaian Gym"
            },
            {
                id: 3,
                nama: "Sarung Tangan Fitness Pro",
                deskripsi: "Sarung tangan dengan grip kuat dan bantalan nyaman untuk angkat beban.",
                harga: 75000,
                gambar: "img/Sarung Tangan Fitness Pro.png",
                kategori: "Aksesoris"
            },
            {
                id: 4,
                nama: "Botol Minum Smart Hydration",
                deskripsi: "Botol minum pintar dengan pengingat hidrasi, kapasitas 750ml.",
                harga: 120000,
                gambar: "img/Botol Minum Smart Hydration.jpg",
                kategori: "Aksesoris"
            },
            {
                id: 5,
                nama: "Matras Yoga Anti-Slip",
                deskripsi: "Matras yoga tebal dan anti-slip untuk kenyamanan maksimal saat berlatih.",
                harga: 210000,
                gambar: "img/Matras Yoga Anti-Slip.jpg",
                kategori: "Perlengkapan Olahraga"
            },
            {
                id: 6,
                nama: "Dumbbell Set Adjustable",
                deskripsi: "Set dumbbell yang bisa disesuaikan bebannya, hemat tempat.",
                harga: 450000,
                gambar: "img/Dumbbell Set Adjustable.jpg",
                kategori: "Perlengkapan Olahraga"
            },
            {
                id: 7,
                nama: "Jaket Windbreaker Sport",
                deskripsi: "Jaket ringan dan tahan angin, cocok untuk lari pagi atau bersepeda.",
                harga: 299000,
                gambar: "img/Jaket Windbreaker Sport.jpg",
                kategori: "Pakaian Gym"
            },
            {
                id: 8,
                nama: "Tali Skipping Pro Speed",
                deskripsi: "Tali skipping dengan bantalan ergonomis dan kecepatan tinggi.",
                harga: 55000,
                gambar: "img/Tali Skipping Pro Speed.jpg",
                kategori: "Perlengkapan Olahraga"
            }
        ];

        const productGrid = document.getElementById('productGrid');
        const categoryFilter = document.getElementById('categoryFilter');
        const priceSort = document.getElementById('priceSort');
        const searchProduct = document.getElementById('searchProduct');
        const searchButton = document.getElementById('searchButton');
        const noProductsFound = document.getElementById('noProductsFound');

        let filteredProducts = [...products]; // Salinan produk untuk filter

        // Fungsi untuk menampilkan produk
        function displayProducts(productsToDisplay) {
            productGrid.innerHTML = ''; // Bersihkan grid sebelumnya
            if (productsToDisplay.length === 0) {
                noProductsFound.style.display = 'block';
            } else {
                noProductsFound.style.display = 'none';
                productsToDisplay.forEach(product => {
                    const col = document.createElement('div');
                    col.className = 'col';
                    col.innerHTML = `
                        <div class="card h-100 product-card">
                            <img src="${product.gambar}" class="card-img-top" alt="${product.nama}">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">${product.nama}</h5>
                                <p class="card-text">${product.deskripsi.substring(0, 70)}...</p>
                                <p class="card-text text-muted mb-1"><small>${product.kategori}</small></p>
                                <p class="price mt-auto">Rp ${product.harga.toLocaleString('id-ID')}</p>
                                <a href="#" class="btn btn-primary mt-2">Lihat Detail</a>
                            </div>
                        </div>
                    `;
                    productGrid.appendChild(col);
                });
            }
        }

        // Fungsi untuk mengisi filter kategori secara dinamis
        function populateCategories() {
            const categories = new Set(products.map(product => product.kategori));
            categories.forEach(category => {
                const option = document.createElement('option');
                option.value = category;
                option.textContent = category;
                categoryFilter.appendChild(option);
            });
        }

        // Fungsi untuk menerapkan semua filter dan pencarian
        function applyFilters() {
            let tempProducts = [...products];

            // 1. Filter berdasarkan kategori
            const selectedCategory = categoryFilter.value;
            if (selectedCategory !== 'all') {
                tempProducts = tempProducts.filter(product => product.kategori === selectedCategory);
            }

            // 2. Pencarian berdasarkan nama produk
            const searchTerm = searchProduct.value.toLowerCase();
            if (searchTerm) {
                tempProducts = tempProducts.filter(product =>
                    product.nama.toLowerCase().includes(searchTerm)
                );
            }

            // 3. Urutkan berdasarkan harga
            const sortOrder = priceSort.value;
            if (sortOrder === 'asc') {
                tempProducts.sort((a, b) => a.harga - b.harga);
            } else if (sortOrder === 'desc') {
                tempProducts.sort((a, b) => b.harga - a.harga);
            }

            filteredProducts = tempProducts;
            displayProducts(filteredProducts);
        }

        // Event Listeners
        categoryFilter.addEventListener('change', applyFilters);
        priceSort.addEventListener('change', applyFilters);
        searchProduct.addEventListener('keyup', applyFilters); // Pencarian real-time
        searchButton.addEventListener('click', applyFilters); // Tombol search (jika diinginkan)

        // Inisialisasi:
        document.addEventListener('DOMContentLoaded', () => {
            populateCategories(); // Isi filter kategori saat DOM siap
            displayProducts(products); // Tampilkan semua produk saat pertama kali load
        });
   