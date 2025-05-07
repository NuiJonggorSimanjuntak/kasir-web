<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di TOKO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .product-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 1rem;
            text-align: center;
            position: relative;
            height: 100%;
        }

        .product-card img {
            width: 100%;
            max-width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 1rem;
        }

        .badge-so {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #000;
            color: #fff;
            font-size: 0.75rem;
            padding: 2px 6px;
            border-radius: 10px;
        }

        .star {
            color: gold;
        }

        .cart-box {
            border: 1px solid #000;
            border-radius: 10px;
            padding: 5px 12px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-right: 4px;
        }

        .cart-badge {
            background-color: #000;
            color: #fff;
            border-radius: 50%;
            padding: 4px 10px;
            font-weight: bold;
            font-size: 14px;
        }

        .product-image {
            background-color: #dce0e5;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        .product-label {
            font-size: 0.9rem;
            color: #666;
        }

        @media (max-width: 576px) {
            .product-card img {
                max-width: 100px;
                height: 100px;
            }

            .cart-box {
                font-size: 0.9rem;
                padding: 5px 8px;
            }
        }
    </style>
</head>

<body>

    <?= $this->include('templates/navbar2'); ?>

    <?= $this->renderSection('page-content'); ?>

    <script>
        const toggleBtn = document.getElementById('toggleBtn');
        let expanded = false;

        toggleBtn?.addEventListener('click', function() {
            const items = document.querySelectorAll('.more-produk');
            items.forEach(el => el.classList.toggle('d-none'));
            expanded = !expanded;
            toggleBtn.textContent = expanded ? 'Tampilkan Lebih Sedikit' : 'Lihat Selengkapnya';
        });
    </script>

</body>

</html>