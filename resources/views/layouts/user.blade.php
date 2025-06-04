<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Beranda') - Dakun99 Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #8B4513;
            --primary-light: #A0522D;
            --secondary: #F5F5DC;
            --accent: #DEB887;
            --text-dark: #2C2C2C;
            --text-light: #666;
            --bg-main: #FAFAFA;
            --white: #FFFFFF;
            --border: #E8E8E8;
            --shadow-light: rgba(0, 0, 0, 0.03);
            --shadow-medium: rgba(0, 0, 0, 0.08);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .pagination {
            justify-content: center;
            margin-top: 20px;
        }

        .page-link {
            color: var(--primary-color);
            border: 1px solid var(--border-color);
            padding: 8px 14px;
            border-radius: 8px;
            transition: all 0.2s ease-in-out;
            font-weight: 500;
        }

        .page-link:hover {
            background-color: var(--primary-light);
            border-color: var(--primary-color);
            color: var(--text-primary);
        }

        .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: #fff;
        }


        body {
            background: var(--bg-main);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: var(--text-dark);
            line-height: 1.6;
        }

        /* Navbar Styles */
        .navbar {
            background: var(--white);
            box-shadow: 0 1px 3px var(--shadow-light);
            border-bottom: 1px solid var(--border);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.5rem;
            color: var(--primary) !important;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar-brand img {
            width: 32px;
            height: 32px;
            object-fit: contain;
        }

        .nav-link {
            color: var(--text-light) !important;
            font-weight: 400;
            font-size: 0.95rem;
            padding: 0.5rem 1rem !important;
            border-radius: 6px;
            transition: all 0.2s ease;
            position: relative;
        }

        .nav-link:hover {
            color: var(--primary) !important;
            background: var(--secondary);
        }

        .nav-link.active {
            color: var(--primary) !important;
            background: var(--secondary);
        }

        .nav-link i {
            font-size: 0.9rem;
            margin-right: 0.4rem;
        }

        .dropdown-menu {
            border: 1px solid var(--border);
            border-radius: 8px;
            box-shadow: 0 4px 12px var(--shadow-medium);
            padding: 0.5rem 0;
            margin-top: 0.5rem;
        }

        .dropdown-item {
            padding: 0.7rem 1.2rem;
            font-size: 0.9rem;
            color: var(--text-light);
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background: var(--secondary);
            color: var(--primary);
        }

        /* Main Container */
        .container {
            max-width: 1200px;
        }

        /* Carousel Styles */
        .carousel {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 16px var(--shadow-medium);
            margin-bottom: 3rem;
        }

        .carousel-item img {
            height: 300px;
            object-fit: cover;
            width: 100%;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 40px;
            height: 40px;
            background: var(--white);
            border-radius: 20px;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.8;
            transition: all 0.3s ease;
        }

        .carousel-control-prev {
            left: 20px;
        }

        .carousel-control-next {
            right: 20px;
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            opacity: 1;
            background: var(--primary);
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-size: 20px;
            filter: invert(1);
        }

        .carousel-control-prev:hover .carousel-control-prev-icon,
        .carousel-control-next:hover .carousel-control-next-icon {
            filter: invert(0);
        }

        /* Section Title */
        .section-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 2rem;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            border-radius: 2px;
        }

        /* Product Card */
        .product-card {
            background: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px var(--shadow-light);
            transition: all 0.3s ease;
            border: 1px solid var(--border);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px var(--shadow-medium);
        }

        .product-card img {
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover img {
            transform: scale(1.05);
        }

        .card-body {
            padding: 1.2rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 500;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .text-muted {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary) !important;
            margin-bottom: 1rem;
        }

        .btn-primary {
            background: var(--primary);
            color: var(--white);
            border: none;
            padding: 0.7rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            margin-top: auto;
        }

        .btn-primary:hover {
            background: var(--primary-light);
            color: var(--white);
            transform: translateY(-1px);
        }

        /* Empty State */
        .text-center.text-muted {
            padding: 3rem 1rem;
            color: var(--text-light) !important;
            font-size: 1rem !important;
            font-weight: 400 !important;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .carousel-item img {
                height: 220px;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .navbar-nav {
                margin-top: 1rem;
            }

            .nav-link {
                padding: 0.7rem 1rem !important;
            }
        }

        @media (max-width: 576px) {

            .carousel-control-prev,
            .carousel-control-next {
                width: 35px;
                height: 35px;
            }

            .carousel-control-prev {
                left: 15px;
            }

            .carousel-control-next {
                right: 15px;
            }
        }
    </style>
</head>

<body>
    @include('partials.user-navbar')

    <div class="container py-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
