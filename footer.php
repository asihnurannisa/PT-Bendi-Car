<!-- footer.php -->
<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
<style>
    /* Footer Container */
/* Footer Styles */
footer {
    background-color: #f8f9fa;
    color: #333;
    padding: 20px 0;
    font-family: Arial, sans-serif;
}

.footer-container {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    max-width: 1200px;
    margin: 0 auto;
}

.footer-section {
    margin: 10px;
}

.footer-section h3 {
    font-size: 16px;
    margin-bottom: 10px;
    color:rgb(60, 1, 25);
}

.footer-section ul {
    list-style: none;
    padding: 0;
}

.footer-section ul li {
    margin-bottom: 5px;
}

.footer-section ul li a {
    text-decoration: none;
    color: #333;
    font-size: 14px;
}

.footer-section ul li a:hover {
    color:rgb(57, 3, 33);
}

.social-icons a {
    margin-right: 10px;
    font-size: 20px;
    color: #333;
}

.social-icons a:hover {
    color:rgb(60, 3, 27);
}

.footer-bottom {
    text-align: center;
    border-top: 1px solid #ddd;
    margin-top: 10px;
    padding-top: 10px;
    font-size: 14px;
}

.footer-bottom a {
    color:rgb(81, 5, 53);
    text-decoration: none;
}

.footer-bottom a:hover {
    text-decoration: underline;
}
</style>

<!-- footer.php -->
<footer>
    <div class="footer-container">
        <div class="footer-section">
            <h3>PRODUK & LAYANAN</h3>
            <ul>
                <li><a href="#">Rental Mobil</a></li>
                <li><a href="#">Driver Gratis</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h3>TENTANG KAMI</h3>
            <ul>
                <li><a href="kontak.php">Profil</a></li>
                <li><a href="#">Sejarah</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h3>PUSAT BANTUAN</h3>
            <ul>
                <li><a href="#">FAQ</a></li>
                <li><a href="kontak.php">Hubungi Kami</a></li>
            </ul>
        </div>

        <div class="footer-section social">
            <h3>IKUTI KAMI</h3>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>© 2024 TRAC. By.ASIH NUR ANNISA | <a href="#">PT BENDI CAR</a></p>
    </div>
    
</footer>
