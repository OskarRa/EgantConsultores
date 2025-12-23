<?php
// footer.php
?>
            </main> <!-- cierre de <main> -->
        </div> <!-- cierre de <div class="row g-0"> -->
    </div> <!-- cierre de <div class="container-fluid"> -->

    <footer class="bg-dark text-light text-center py-3 mt-4">
        <div class="container">
            <p class="mb-1">
                <a href="<?php echo BASE_URL; ?>index.php?page=terminos" class="text-light text-decoration-none">Términos</a> |
                <a href="<?php echo BASE_URL; ?>index.php?page=privacidad" class="text-light text-decoration-none">Política de Privacidad</a> |
                <a href="<?php echo BASE_URL; ?>index.php?page=ayuda" class="text-light text-decoration-none">Ayuda</a>
            </p>
            <p class="mb-0">&copy; <?php echo date('Y'); ?> Egant Consultores</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
