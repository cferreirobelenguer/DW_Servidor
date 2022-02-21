</div>
</div>

<!-- PIE DE PÁGINA -->
<footer>
	<div class="d-flex justify-content-center bg-dark text-white">
		<br>
	</div>
	<div class="d-flex justify-content-center bg-dark text-white">
		<br>
		<?php $categorias = Utils::showCategorias(); ?>
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
			<div class="container">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url ?>">Inicio</a>
					</li>
					<?php while ($cat = $categorias->fetch_object()) : ?>
						<li class="nav-item">
							<a class="nav-link" href="<?= base_url ?>categoria/ver&id=<?= $cat->id ?>"><?= $cat->nombre ?></a>
						</li>
					<?php endwhile; ?>
				</ul>
			</div>
		</nav>
	</div>
	<div class="d-flex justify-content-center bg-dark text-white">
		<!--La imagen lleva alt con descripción como punto 1 de accesibilidad A-->
		<img src="<?= base_url ?>assets/img/noa2.png" class="img-fluid" alt="footer_logo_noa" width="200" height="200" />
	</div>
	<div class="d-flex justify-content-center bg-dark text-white">
		<h5>Métodos de pago</h5>
	</div>

	<div class="d-flex justify-content-center bg-dark text-white">
		<!--ICONOS EN BOOTSTRAP-->
		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-paypal" viewBox="0 0 16 16">
			<path d="M14.06 3.713c.12-1.071-.093-1.832-.702-2.526C12.628.356 11.312 0 9.626 0H4.734a.7.7 0 0 0-.691.59L2.005 13.509a.42.42 0 0 0 .415.486h2.756l-.202 1.28a.628.628 0 0 0 .62.726H8.14c.429 0 .793-.31.862-.731l.025-.13.48-3.043.03-.164.001-.007a.351.351 0 0 1 .348-.297h.38c1.266 0 2.425-.256 3.345-.91.379-.27.712-.603.993-1.005a4.942 4.942 0 0 0 .88-2.195c.242-1.246.13-2.356-.57-3.154a2.687 2.687 0 0 0-.76-.59l-.094-.061ZM6.543 8.82a.695.695 0 0 1 .321-.079H8.3c2.82 0 5.027-1.144 5.672-4.456l.003-.016c.217.124.4.27.548.438.546.623.679 1.535.45 2.71-.272 1.397-.866 2.307-1.663 2.874-.802.57-1.842.815-3.043.815h-.38a.873.873 0 0 0-.863.734l-.03.164-.48 3.043-.024.13-.001.004a.352.352 0 0 1-.348.296H5.595a.106.106 0 0 1-.105-.123l.208-1.32.845-5.214Z" />
		</svg>&nbsp;&nbsp;&nbsp;
		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
			<path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z" />
		</svg>
	</div>
	<div class="d-flex justify-content-center bg-dark text-white">
		<br>
	</div>
	<div class="d-flex justify-content-center bg-dark text-white">
		<!--La imagen lleva alt con descripción como punto 1 de accesibilidad A-->
		<img src="<?= base_url ?>assets/img/footer.png" class="img-fluid" alt="footer_corazon" width="20" height="20" />
	</div>
	<div class="d-flex justify-content-center bg-dark text-white">
		<br>
	</div>
	<div class="d-flex justify-content-center bg-dark text-white">
		<h5>Síguenos : </h5>
	</div>
	<div class="d-flex justify-content-center bg-dark text-white">
		<br>
		<!--ICONOS EN BOOTSTRAP-->
		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
			<path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
		</svg>&nbsp;&nbsp;&nbsp;
		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
			<path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
		</svg>
	</div>
	<div class="d-flex justify-content-center bg-dark text-white">
		<br>
	</div>
	<div class="d-flex justify-content-center bg-dark text-white">
		<p> &copy; Todos los derechos reservados <?= date('Y') ?></p>
	</div>
	<div class="d-flex justify-content-center bg-dark text-white">
		<br>
	</div>
	<div class="d-flex justify-content-center bg-dark text-white">
		<br>
	</div>

</footer>
</div>
</body>

</html>