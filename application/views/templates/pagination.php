<?php if ($total_paginas > 1): ?>

    <nav class="pagination-container">
        <ul class="pagination">
			<li class="page-item <?= ($pagina_actual == 1) ? 'disabled' : '' ?>">
				<a class="page-link" href="?page=1&cantidad=<?= $cantidad_por_pagina ?>">First</a>
			</li>

            <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                <li class="page-item <?= $i == $pagina_actual ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>&cantidad=<?= $cantidad_por_pagina ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

			<li class="page-item <?= ($pagina_actual == $total_paginas) ? 'disabled' : '' ?>">
        		<a class="page-link" href="?page=<?= $total_paginas ?>&cantidad=<?= $cantidad_por_pagina ?>">Last</a>
    		</li>
        </ul>
    </nav>
<?php endif; ?>
