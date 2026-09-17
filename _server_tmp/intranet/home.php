<?php
require_once("../scripts/php/funcoes.php");
require_once("../scripts/php/paginacao.php");  

$TidEntidade = $_SESSION['SuserEnt'];
$TuserId     = $_SESSION['SuserId'];

$iconAvisos      = '../layout/imagens/iconsIntranetNova/iconsCardAvisosIntranet/';
$iconSistemas    = '../layout/imagens/iconsIntranetNova/iconsCardMeusSistemasIntranet/';
$iconCalendario  = '../layout/imagens/iconsIntranetNova/iconsCalendario/';

if (!function_exists('intranetAssetUrl')) {
    function intranetAssetUrl($relativePath) {
        $parts = explode('/', str_replace('\\', '/', $relativePath));
        $file = array_pop($parts);
        $dir = implode('/', $parts);
        if ($dir !== '') {
            return $dir . '/' . rawurlencode($file);
        }
        return rawurlencode($file);
    }
}

if (!function_exists('getMesAbrev')) {
    function getMesAbrev($mesNum) {
        $meses = [
            1 => 'jan', 2 => 'fev', 3 => 'mar', 4 => 'abr', 5 => 'mai', 6 => 'jun',
            7 => 'jul', 8 => 'ago', 9 => 'set', 10 => 'out', 11 => 'nov', 12 => 'dez'
        ];
        return isset($meses[(int)$mesNum]) ? $meses[(int)$mesNum] : 'jun';
    }
}

if (!function_exists('getSistemaIconSvg')) {
    function getSistemaIconSvg($nome) {
        if (function_exists('intranetResolveSistemaIconFa')) {
            return intranetResolveSistemaIconFa($nome);
        }
        return 'fa-solid fa-cubes';
    }
}
?>

<script>
// Banner slide logic — fade suave (~0.4s), sem paginação numérica
document.addEventListener("DOMContentLoaded", function() {
    const slides = document.querySelectorAll("#banner .banner-slide");
    const prevBtn = document.getElementById("btn-prev");
    const nextBtn = document.getElementById("btn-next");
    let currentSlide = 0;
    let slideInterval;
    let isAnimating = false;

    if (slides.length === 0) return;

    // Pré-carrega imagens para evitar atraso na troca
    slides.forEach(function(slide) {
        const img = slide.querySelector("img");
        if (img && img.getAttribute("src")) {
            const preload = new Image();
            preload.src = img.getAttribute("src");
            img.addEventListener("error", function() {
                img.style.display = "none";
                if (slide.querySelector(".banner-fallback")) return;
                const fallback = document.createElement("div");
                fallback.className = "banner-fallback";
                fallback.style.cssText = "width:100%;height:100%;min-height:280px;background:linear-gradient(135deg,#003063 0%,#001c38 100%);";
                slide.querySelector("a").insertBefore(fallback, slide.querySelector("a").firstChild);
            });
        }
    });

    function showSlide(index) {
        if (isAnimating || slides.length <= 1) {
            if (slides.length <= 1) return;
        }
        isAnimating = true;
        slides[currentSlide].classList.remove("active");
        currentSlide = (index + slides.length) % slides.length;
        slides[currentSlide].classList.add("active");
        setTimeout(function() {
            isAnimating = false;
        }, 420);
    }

    function nextSlide() {
        showSlide(currentSlide + 1);
    }

    function prevSlide() {
        showSlide(currentSlide - 1);
    }

    function startAutoSlide() {
        if (slides.length <= 1) return;
        clearInterval(slideInterval);
        slideInterval = setInterval(nextSlide, 6000);
    }

    function resetAutoSlide() {
        clearInterval(slideInterval);
        startAutoSlide();
    }

    if (nextBtn) {
        nextBtn.addEventListener("click", function(e) {
            e.preventDefault();
            e.stopPropagation();
            nextSlide();
            resetAutoSlide();
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener("click", function(e) {
            e.preventDefault();
            e.stopPropagation();
            prevSlide();
            resetAutoSlide();
        });
    }

    // Remove qualquer paginação numérica injetada por plugins (SlidesJS etc.)
    function removePagination() {
        document.querySelectorAll(".intranet-home .pagination, #coluna_esquerda .pagination, #banner .pagination").forEach(function(el) {
            el.remove();
        });
    }
    removePagination();
    setTimeout(removePagination, 300);
    setTimeout(removePagination, 1000);

    startAutoSlide();
});
</script>

<div class="centro intranet-home">

    <!-- ============================== -->
    <!-- COLUNA ESQUERDA: Banner + Cards -->
    <!-- ============================== -->
    <div id="coluna_esquerda">

        <!-- BANNER / CARROSSEL -->
        <div id="banner">
            <div class="slider-container2">
                <?php
                if (!function_exists('intranetResolveBannerLink')) {
                    /**
                     * Mantém o link cadastrado no CMS. Se estiver vazio, tenta
                     * direcionar para uma notícia relacionada (por título ou
                     * notícia mais recente da mesma entidade do banner).
                     */
                    function intranetResolveBannerLink($drive, $objBanner) {
                        $link = trim((string)$objBanner->cms_banner_link);
                        if ($link !== '' && $link !== '#') {
                            return $link;
                        }

                        $titulo = trim(html_entity_decode((string)$objBanner->cms_banner_titulo, ENT_QUOTES, 'UTF-8'));
                        $entId = (int)$objBanner->cms_banner_entidade_id;
                        $notiId = 0;
                        $entPath = '';

                        if ($titulo !== '') {
                            $tituloBusca = preg_replace('/\s+/', ' ', $titulo);
                            $tituloBusca = mb_substr($tituloBusca, 0, 50);
                            $tituloEsc = str_replace("'", "''", $tituloBusca);
                            $sqlTitulo = "
                                SELECT noti_id, noti_entidade_id
                                  FROM noticias
                                 WHERE noti_status = 't'
                                   AND noti_titulo ILIKE '%{$tituloEsc}%'
                              ORDER BY noti_data DESC, noti_id DESC
                                 LIMIT 1
                            ";
                            $rTitulo = $drive->pedido($sqlTitulo);
                            if ($rTitulo && ($rowTitulo = pg_fetch_object($rTitulo))) {
                                $notiId = (int)$rowTitulo->noti_id;
                                $entId = (int)$rowTitulo->noti_entidade_id > 0 ? (int)$rowTitulo->noti_entidade_id : $entId;
                            }
                        }

                        if ($notiId <= 0 && $entId > 0) {
                            $sqlEnt = "
                                SELECT n.noti_id
                                  FROM noticias n
                                 WHERE n.noti_entidade_id = {$entId}
                                   AND n.noti_status = 't'
                              ORDER BY n.noti_data DESC, n.noti_id DESC
                                 LIMIT 1
                            ";
                            $rEnt = $drive->pedido($sqlEnt);
                            if ($rEnt && ($rowEnt = pg_fetch_object($rEnt))) {
                                $notiId = (int)$rowEnt->noti_id;
                            }
                        }

                        if ($entId > 0) {
                            $sqlPath = "SELECT entidade_path FROM entidades WHERE entidade_id = {$entId} LIMIT 1";
                            $rPath = $drive->pedido($sqlPath);
                            if ($rPath && ($rowPath = pg_fetch_object($rPath))) {
                                $entPath = trim((string)$rowPath->entidade_path);
                            }
                        }

                        if ($notiId > 0) {
                            if ($entPath !== '') {
                                return 'https://www.pmf.sc.gov.br/entidades/' . rawurlencode($entPath) . '/index.php?pagina=notpagina&noti=' . $notiId;
                            }
                            return 'https://www.pmf.sc.gov.br/noticias/index.php?pagina=notpagina&noti=' . $notiId;
                        }

                        if ($entPath !== '') {
                            return 'https://www.pmf.sc.gov.br/entidades/' . rawurlencode($entPath) . '/';
                        }

                        return 'https://www.pmf.sc.gov.br/noticias/index.php';
                    }
                }

                // Mesmos banners de antes — só completa o direcionamento quando o link estiver vazio
                $sqlBanner = "SELECT * FROM cms_banner
                                ORDER BY cms_banner_ordem ASC, cms_banner_id ASC
                                LIMIT 10";

                $rBanner = $drive->pedido($sqlBanner);
                $index = 0;

                while ($objBanner = pg_fetch_object($rBanner)) {
                    $linkRaw = intranetResolveBannerLink($drive, $objBanner);
                    $link = htmlspecialchars($linkRaw, ENT_QUOTES, 'UTF-8');
                    $path = htmlspecialchars((string)$objBanner->cms_banner_path, ENT_QUOTES, 'UTF-8');
                    $titulo = htmlspecialchars((string)$objBanner->cms_banner_titulo, ENT_QUOTES, 'UTF-8');
                    $subtitulo = htmlspecialchars((string)$objBanner->cms_banner_subtitulo, ENT_QUOTES, 'UTF-8');
                    $isExternal = (stripos($linkRaw, 'http://') === 0 || stripos($linkRaw, 'https://') === 0);
                    $targetAttrs = $isExternal ? ' target="_blank" rel="noopener noreferrer"' : '';
                    $activeClass = ($index === 0) ? 'active' : '';
                ?>
                    <div class="banner-slide <?= $activeClass ?>">
                        <a href="<?= $link ?>"<?= $targetAttrs ?>>
                            <img src="../arquivos/banners/<?= $path ?>" alt="<?= $titulo ?>" loading="<?= $index === 0 ? 'eager' : 'lazy' ?>" />
                            <div class="banner-overlay-content">
                                <span class="banner-badge">Portal do Servidor</span>
                                <h2 class="banner-title"><?= !empty($objBanner->cms_banner_titulo) ? $titulo : 'A Capital da Inovação e Eficiência' ?></h2>
                                <p class="banner-description"><?= !empty($objBanner->cms_banner_subtitulo) ? $subtitulo : 'Bem-vindo à nova intranet. Centralizando serviços, ferramentas e informações para o seu dia a dia profissional.' ?></p>
                            </div>
                        </a>
                    </div>
                <?php
                    $index++;
                }

                if ($index === 0) {
                ?>
                    <div class="banner-slide active">
                        <a href="https://www.pmf.sc.gov.br/noticias/index.php" target="_blank" rel="noopener noreferrer">
                            <div style="width: 100%; height: 100%; min-height: 280px; background: linear-gradient(135deg, #003063 0%, #001c38 100%);"></div>
                            <div class="banner-overlay-content">
                                <span class="banner-badge">Portal do Servidor</span>
                                <h2 class="banner-title">A Capital da Inovação e Eficiência</h2>
                                <p class="banner-description">Bem-vindo à nova intranet. Centralizando serviços, ferramentas e informações para o seu dia a dia profissional.</p>
                            </div>
                        </a>
                    </div>
                <?php
                }
                ?>
            </div>

            <a href="#" class="banner-prev" id="btn-prev" aria-label="Slide anterior"></a>
            <a href="#" class="banner-next" id="btn-next" aria-label="Próximo slide"></a>
        </div>

        <?php
        $menuParam = isset($_GET['menu']) ? (string)$_GET['menu'] : '';
        // Usa atalho histórico sistfavs (menu/BD). UI moderna em sist_favoritos.php → sist_acessos.php
        $acessosHref = 'inicio.php?pagina=sistfavs' . ($menuParam !== '' ? '&menu=' . rawurlencode($menuParam) : '');
        $avisosListaHref = 'inicio.php?pagina=avisoconsulta' . ($menuParam !== '' ? '&menu=' . rawurlencode($menuParam) : '');

        require_once __DIR__ . '/includes/pmf_sistemas_urls.php';

        if (!function_exists('getSistemaIcon')) {
            function getSistemaIcon($nome) {
                return getSistemaIconSvg($nome);
            }
        }

        if (!function_exists('intranetSistemaHref')) {
            function intranetSistemaHref($sistema, $menuParam) {
                if (function_exists('intranetResolveSistemaCardHref')) {
                    return intranetResolveSistemaCardHref($sistema, $menuParam);
                }
                return intranetResolveSistemaHref($sistema, $menuParam);
            }
        }

        if (!function_exists('intranetSistemaIsExternal')) {
            function intranetSistemaIsExternal($href) {
                return (stripos($href, 'http://') === 0 || stripos($href, 'https://') === 0);
            }
        }

        if (!function_exists('renderIntranetSistemaCard')) {
            function renderIntranetSistemaCard($nome, $href, $iconSrc) {
                $nomeEsc = htmlspecialchars($nome, ENT_QUOTES, 'UTF-8');
                $hrefEsc = htmlspecialchars($href, ENT_QUOTES, 'UTF-8');
                $target = intranetSistemaIsExternal($href) ? ' target="_blank" rel="noopener noreferrer"' : '';
                // $iconSrc pode ser classe FA ou path legado; preferir HTML FA
                if (function_exists('intranetRenderSistemaIconHtml')) {
                    $iconHtml = intranetRenderSistemaIconHtml($nome);
                } elseif (is_string($iconSrc) && strpos($iconSrc, 'fa-') === 0) {
                    $iconHtml = '<i class="' . htmlspecialchars($iconSrc . ' pmf-sistema-fa', ENT_QUOTES, 'UTF-8') . '" aria-hidden="true"></i>';
                } else {
                    $iconEsc = htmlspecialchars(intranetAssetUrl($iconSrc), ENT_QUOTES, 'UTF-8');
                    $iconHtml = '<img src="' . $iconEsc . '" alt="" />';
                }
                echo '<a href="' . $hrefEsc . '" class="sistema-card"' . $target . '>'
                    . '<span class="sistema-icon">' . $iconHtml . '</span>'
                    . '<span>' . $nomeEsc . '</span>'
                    . '</a>';
            }
        }
        ?>

        <!-- MEUS SISTEMAS (1º card) -->
        <div id="bloco-sistemas" class="box-intranet">
            <div class="titulo-bloco">
                <label><img class="bloco-icon" src="<?= intranetAssetUrl($iconSistemas . 'simboloSistemasCard.svg') ?>" alt="" /> Meus Sistemas</label>
                <a href="<?= htmlspecialchars($acessosHref, ENT_QUOTES, 'UTF-8') ?>">Editar</a>
            </div>
            
            <div class="sistemas-grid">
                <?php
                $sistemasCards = [];
                $TidUserSafe = (int)$TuserId;
                $TidEntidadeSafe = (int)$TidEntidade;

                // 1) Favoritos do usuário (intranet_favoritos + intranet_sistemas)
                $TsistemaSql = "
                    SELECT intranet_sistemas.*
                      FROM intranet_favoritos
                 LEFT JOIN intranet_sistemas
                        ON intranet_favoritos_sistema_id = intranet_sistemas_id
                     WHERE intranet_favoritos_user_id = {$TidUserSafe}
                       AND intranet_sistemas_id IS NOT NULL
                  ORDER BY intranet_favoritos_id ASC
                     LIMIT 4
                ";
                $TretornoSis = $drive->pedido($TsistemaSql);
                while ($sistema = pg_fetch_object($TretornoSis)) {
                    $sistemasCards[] = $sistema;
                }

                $temFavoritos = count($sistemasCards) > 0;

                if ($temFavoritos) {
                    // Favoritos fixados: sempre exibir no card (URL oficial → endereço → sistdesc)
                    foreach ($sistemasCards as $sistema) {
                        $href = intranetSistemaHref($sistema, $menuParam);
                        if ($href === '') {
                            $href = $acessosHref;
                        }
                        renderIntranetSistemaCard(
                            $sistema->intranet_sistemas_nome,
                            $href,
                            getSistemaIconSvg($sistema->intranet_sistemas_nome)
                        );
                    }
                } else {
                    // Sem favoritos: atalhos oficiais do Portal (nunca o catálogo Performer legado)
                    $demoSistemas = [
                        ['Folha Online', $iconSistemas . 'folhaOnlineCardIcon.svg'],
                        ['Agendamentos', $iconSistemas . 'agendamentosCardIcon.svg'],
                        ['GestaDoc', $iconSistemas . 'gestaDocCardIcon.svg'],
                    ];
                    foreach ($demoSistemas as $demo) {
                        $demoNome = $demo[0];
                        $demoHref = intranetKnownSistemaUrl($demoNome);
                        if ($demoHref === '') {
                            $demoHref = $acessosHref;
                        }
                        renderIntranetSistemaCard($demoNome, $demoHref, $demo[1]);
                    }
                }

                // Sem favoritos: 4º card abre a página de gerenciamento de acessos rápidos
                if (!$temFavoritos) {
                    renderIntranetSistemaCard(
                        'Crie meus favoritos',
                        $acessosHref,
                        $iconSistemas . 'simboloSistemasCard.svg'
                    );
                }
                ?>
            </div>

        </div>

        <!-- AVISOS RECENTES (2º card) -->
        <div id="bloco-avisos" class="box-intranet">
            <div class="titulo-bloco">
                <label><img class="bloco-icon" src="<?= intranetAssetUrl($iconAvisos . 'iconAvisosCardAvisos.svg') ?>" alt="" /> Avisos Recentes</label>
                <a href="<?= htmlspecialchars($avisosListaHref, ENT_QUOTES, 'UTF-8') ?>">Ver todos</a>
            </div>
            <ul>
                <?php
                $TavisoSql = "SELECT * FROM intranet_avisos WHERE intranet_avisos_entidade_id = " . (int)$TidEntidade . " ORDER BY intranet_avisos_id DESC LIMIT 2";
                $TretornoAvi = $drive->pedido($TavisoSql);
                $i = 0;
                while ($aviso = pg_fetch_object($TretornoAvi)) {
                    $Tdata = explode('-', $aviso->intranet_avisos_data);
                    $Tmes = getMesAbrev($Tdata[1]);
                    $Tdia = isset($Tdata[2]) ? $Tdata[2] : '01';

                    $textoResumo = strip_tags(html_entity_decode($aviso->intranet_avisos_texto, ENT_QUOTES, 'UTF-8'));
                    if (mb_strlen($textoResumo) > 130) {
                        $textoResumo = mb_substr($textoResumo, 0, 130) . '...';
                    }

                    // Página associada: comunic/intra_aviso.php (atalho "aviso")
                    $avisoHref = 'inicio.php?pagina=aviso&aviso_id=' . (int)$aviso->intranet_avisos_id;
                    if ($menuParam !== '') {
                        $avisoHref .= '&menu=' . rawurlencode($menuParam);
                    }
                ?>
                    <li>
                        <div class="aviso-date-block">
                            <span class="aviso-date-month"><?= $Tmes ?></span>
                            <span class="aviso-date-day"><?= htmlspecialchars($Tdia, ENT_QUOTES, 'UTF-8') ?></span>
                        </div>
                        <div class="aviso-content-block">
                            <span class="aviso-title-link"><?= htmlspecialchars($aviso->intranet_avisos_titulo, ENT_QUOTES, 'UTF-8') ?></span>
                            <p class="aviso-desc"><?= htmlspecialchars($textoResumo, ENT_QUOTES, 'UTF-8') ?></p>
                        </div>
                        <a href="<?= htmlspecialchars($avisoHref, ENT_QUOTES, 'UTF-8') ?>" class="aviso-arrow-link" aria-label="Abrir aviso: <?= htmlspecialchars($aviso->intranet_avisos_titulo, ENT_QUOTES, 'UTF-8') ?>">
                            <img class="aviso-arrow" src="<?= intranetAssetUrl($iconAvisos . 'iconSetaCardAvisos.svg') ?>" alt="" />
                        </a>
                    </li>
                <?php
                    $i++;
                }
                if ($i === 0) {
                ?>
                    <li class="aviso-vazio-item">
                        <div class="aviso-content-block">
                            <span class="aviso-title-link">Nenhum aviso recente</span>
                            <p class="aviso-desc">Acompanhe pela Intranet os avisos e informações da sua secretaria ou órgão.</p>
                        </div>
                        <a href="<?= htmlspecialchars($avisosListaHref, ENT_QUOTES, 'UTF-8') ?>" class="aviso-arrow-link" aria-label="Ver lista de avisos">
                            <img class="aviso-arrow" src="<?= intranetAssetUrl($iconAvisos . 'iconSetaCardAvisos.svg') ?>" alt="" />
                        </a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>

    </div><!-- /#coluna_esquerda -->


    <!-- ============================== -->
    <!-- COLUNA DIREITA: Calendário     -->
    <!-- ============================== -->
    <div id="coluna_direita">

        <div id="bloco-calendario" class="box-intranet">
            <div class="titulo-bloco">
                <label><img class="bloco-icon" src="<?= intranetAssetUrl($iconCalendario . 'calendarioIcon.svg') ?>" alt="" /> Calendário</label>
            </div>
            
            <div class="calendar-widget">
                <div class="calendar-header">
                    <div class="calendar-month-year" id="calMonthYear"></div>
                    <div class="calendar-nav-btns">
                        <button type="button" class="calendar-nav-btn" onclick="prevMonth()" aria-label="Mês anterior"><img src="<?= intranetAssetUrl($iconCalendario . 'setaEsquerdaCalendarioIcon.svg') ?>" alt="" /></button>
                        <button type="button" class="calendar-nav-btn" onclick="nextMonth()" aria-label="Próximo mês"><img src="<?= intranetAssetUrl($iconCalendario . 'setaDireitaCalendarioIcon.svg') ?>" alt="" /></button>
                    </div>
                </div>
                <div class="calendar-weekdays">
                    <div class="calendar-weekday">D</div>
                    <div class="calendar-weekday">S</div>
                    <div class="calendar-weekday">T</div>
                    <div class="calendar-weekday">Q</div>
                    <div class="calendar-weekday">Q</div>
                    <div class="calendar-weekday">S</div>
                    <div class="calendar-weekday">S</div>
                </div>
                <div class="calendar-days" id="calendarDays"></div>
            </div>

            <div class="eventos-seccao-titulo" id="eventosSeccaoTitulo">PRÓXIMOS EVENTOS</div>
            
            <div class="eventos-lista" id="eventosLista">
                <?php
                $TdataAtual = date('Y-m-d');
                $calendarEvents = [];

                // Todos os eventos da entidade — sem filtro de data (marcadores filtrados por mês no JS)
                $TidEntidadeSafe = (int)$TidEntidade;
                $TcalSql = "
                    SELECT cal_data, cal_titulo, cal_hora, cal_local, cal_evento
                      FROM calendario
                     WHERE cal_entidade_id = {$TidEntidadeSafe}
                       AND cal_tipo = 0
                  ORDER BY cal_data ASC
                ";
                $TretornoCal = $drive->pedido($TcalSql);

                while ($calendario = pg_fetch_object($TretornoCal)) {
                    $dataIso = substr((string)$calendario->cal_data, 0, 10);
                    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $dataIso)) {
                        continue;
                    }
                    $calendarEvents[] = [
                        'date'  => $dataIso,
                        'title' => (string)$calendario->cal_titulo,
                        'hora'  => !empty($calendario->cal_hora) ? (string)$calendario->cal_hora : '',
                        'local' => !empty($calendario->cal_local) ? (string)$calendario->cal_local : '',
                        'link'  => !empty($calendario->cal_evento) ? (string)$calendario->cal_evento : '',
                    ];
                }

                // Fallback de demonstração enquanto o banco ainda não tiver eventos
                if (count($calendarEvents) === 0) {
                    $calendarEvents = [
                        [
                            'date'  => date('Y-m-d', strtotime('+5 days')),
                            'title' => 'Reunião de Planejamento',
                            'hora'  => '09:00',
                            'local' => 'Auditório Principal',
                            'link'  => '',
                        ],
                        [
                            'date'  => date('Y-m-d', strtotime('+10 days')),
                            'title' => 'Workshop de Inovação',
                            'hora'  => '14:30',
                            'local' => 'Sala de Treinamento',
                            'link'  => '',
                        ],
                    ];
                }

                // Render inicial (próximos eventos a partir de hoje) — o JS passa a controlar a lista
                $mesAbrev = [
                    1 => 'jan', 2 => 'fev', 3 => 'mar', 4 => 'abr', 5 => 'mai', 6 => 'jun',
                    7 => 'jul', 8 => 'ago', 9 => 'set', 10 => 'out', 11 => 'nov', 12 => 'dez'
                ];
                $proximos = array_values(array_filter($calendarEvents, function ($ev) use ($TdataAtual) {
                    return isset($ev['date']) && $ev['date'] >= $TdataAtual;
                }));
                usort($proximos, function ($a, $b) {
                    return strcmp($a['date'], $b['date']);
                });
                $proximos = array_slice($proximos, 0, 3);

                if (count($proximos) === 0) {
                    echo '<p class="evento-vazio">Nenhum evento próximo encontrado.</p>';
                } else {
                    foreach ($proximos as $ev) {
                        $parts = explode('-', $ev['date']);
                        $mes = isset($mesAbrev[(int)$parts[1]]) ? $mesAbrev[(int)$parts[1]] : '';
                        $dia = isset($parts[2]) ? $parts[2] : '';
                        $infoBits = array_filter([
                            !empty($ev['hora']) ? $ev['hora'] : null,
                            !empty($ev['local']) ? $ev['local'] : null,
                        ]);
                        $info = implode(' - ', $infoBits);
                        $titulo = htmlspecialchars($ev['title'], ENT_QUOTES, 'UTF-8');
                        $link = !empty($ev['link']) ? htmlspecialchars($ev['link'], ENT_QUOTES, 'UTF-8') : '';
                        ?>
                    <div class="evento-item" data-event-date="<?= htmlspecialchars($ev['date'], ENT_QUOTES, 'UTF-8') ?>">
                        <div class="evento-date-block">
                            <span class="evento-date-month"><?= htmlspecialchars($mes, ENT_QUOTES, 'UTF-8') ?></span>
                            <span class="evento-date-day"><?= htmlspecialchars($dia, ENT_QUOTES, 'UTF-8') ?></span>
                        </div>
                        <div class="evento-details">
                            <?php if ($link !== '') { ?>
                            <a href="<?= $link ?>" class="evento-title"><?= $titulo ?></a>
                            <?php } else { ?>
                            <span class="evento-title"><?= $titulo ?></span>
                            <?php } ?>
                            <?php if ($info !== '') { ?>
                            <p class="evento-info"><?= htmlspecialchars($info, ENT_QUOTES, 'UTF-8') ?></p>
                            <?php } ?>
                        </div>
                    </div>
                        <?php
                    }
                }
                ?>
            </div>

            <p class="calendario-desc-rodape">Este é o espaço colaborativo da sua secretaria ou órgão. Em breve estarão disponíveis datas de eventos e reuniões internas.</p>
        </div>

    </div><!-- /#coluna_direita -->

</div><!-- /.centro -->

<style type="text/css">
/* Eventos passados: indicador permanece, com tom atenuado (distinto de is-today) */
.intranet-home .calendar-day-cell.has-event.has-event-past:not(.is-selected)::after {
    opacity: 0.5;
}
.intranet-home .calendar-day-cell.has-event.has-event-past.is-today:not(.is-selected)::after {
    opacity: 0.65;
}
</style>

<script>
(function () {
    var viewDate = new Date();
    viewDate.setHours(12, 0, 0, 0);

    var today = new Date();
    today.setHours(12, 0, 0, 0);

    var selectedDate = new Date(today.getTime());
    var calendarEvents = <?= json_encode($calendarEvents, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;

    var monthNames = [
        'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
        'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
    ];
    var mesAbrev = ['jan', 'fev', 'mar', 'abr', 'mai', 'jun', 'jul', 'ago', 'set', 'out', 'nov', 'dez'];

    function normalizeIsoDate(raw) {
        var value = String(raw || '').slice(0, 10);
        return /^\d{4}-\d{2}-\d{2}$/.test(value) ? value : '';
    }

    function toIsoDate(d) {
        var y = d.getFullYear();
        var m = d.getMonth() + 1;
        var day = d.getDate();
        return y + '-' + (m < 10 ? '0' : '') + m + '-' + (day < 10 ? '0' : '') + day;
    }

    function sameDay(a, b) {
        return a.getFullYear() === b.getFullYear()
            && a.getMonth() === b.getMonth()
            && a.getDate() === b.getDate();
    }

    function eventsForDate(iso) {
        var target = normalizeIsoDate(iso);
        if (!target) {
            return [];
        }
        return (calendarEvents || []).filter(function (ev) {
            return ev && normalizeIsoDate(ev.date) === target;
        });
    }

    function monthRangeIso(year, month) {
        var m = month + 1;
        var monthStr = (m < 10 ? '0' : '') + m;
        var lastDay = new Date(year, month + 1, 0).getDate();
        var lastDayStr = (lastDay < 10 ? '0' : '') + lastDay;
        return {
            start: year + '-' + monthStr + '-01',
            end: year + '-' + monthStr + '-' + lastDayStr
        };
    }

    function eventDatesSetForMonth(year, month) {
        var range = monthRangeIso(year, month);
        var map = {};
        (calendarEvents || []).forEach(function (ev) {
            var iso = ev ? normalizeIsoDate(ev.date) : '';
            if (iso && iso >= range.start && iso <= range.end) {
                map[iso] = true;
            }
        });
        return map;
    }

    function renderEventList() {
        var lista = document.getElementById('eventosLista');
        var titulo = document.getElementById('eventosSeccaoTitulo');
        if (!lista || !titulo) return;

        var selectedIso = toIsoDate(selectedDate);
        var todayIso = toIsoDate(today);
        var items = [];

        if (selectedIso === todayIso) {
            titulo.textContent = 'PRÓXIMOS EVENTOS';
            items = (calendarEvents || []).filter(function (ev) {
                return ev && ev.date >= todayIso;
            }).sort(function (a, b) {
                return a.date < b.date ? -1 : (a.date > b.date ? 1 : 0);
            }).slice(0, 3);
        } else {
            titulo.textContent = 'EVENTOS DO DIA';
            items = eventsForDate(selectedIso);
        }

        if (!items.length) {
            lista.innerHTML = selectedIso === todayIso
                ? '<p class="evento-vazio">Nenhum evento próximo encontrado.</p>'
                : '<p class="evento-vazio">Não há eventos nesta data.</p>';
            return;
        }

        var html = '';
        items.forEach(function (ev) {
            var parts = String(ev.date).split('-');
            var mes = mesAbrev[parseInt(parts[1], 10) - 1] || '';
            var dia = parts[2] || '';
            var infoBits = [];
            if (ev.hora) infoBits.push(ev.hora);
            if (ev.local) infoBits.push(ev.local);
            var info = infoBits.join(' - ');
            var titleSafe = String(ev.title || '').replace(/</g, '&lt;').replace(/>/g, '&gt;');
            var titleHtml = ev.link
                ? '<a href="' + String(ev.link).replace(/"/g, '&quot;') + '" class="evento-title">' + titleSafe + '</a>'
                : '<span class="evento-title">' + titleSafe + '</span>';

            html += '<div class="evento-item" data-event-date="' + ev.date + '">'
                + '<div class="evento-date-block">'
                + '<span class="evento-date-month">' + mes + '</span>'
                + '<span class="evento-date-day">' + dia + '</span>'
                + '</div>'
                + '<div class="evento-details">'
                + titleHtml
                + (info ? '<p class="evento-info">' + String(info).replace(/</g, '&lt;') + '</p>' : '')
                + '</div></div>';
        });
        lista.innerHTML = html;
    }

    function renderCalendar() {
        var year = viewDate.getFullYear();
        var month = viewDate.getMonth();
        var firstDayOfMonth = new Date(year, month, 1).getDay();
        var daysInMonth = new Date(year, month + 1, 0).getDate();
        var eventMap = eventDatesSetForMonth(year, month);
        var todayIso = toIsoDate(today);

        var monthYearElem = document.getElementById('calMonthYear');
        if (monthYearElem) {
            monthYearElem.textContent = monthNames[month] + ' ' + year;
        }

        var daysContainer = document.getElementById('calendarDays');
        if (!daysContainer) return;

        daysContainer.innerHTML = '';

        for (var i = 0; i < firstDayOfMonth; i++) {
            var empty = document.createElement('div');
            empty.className = 'calendar-day-cell empty';
            empty.setAttribute('aria-hidden', 'true');
            daysContainer.appendChild(empty);
        }

        for (var day = 1; day <= daysInMonth; day++) {
            var cellDate = new Date(year, month, day, 12, 0, 0, 0);
            var iso = toIsoDate(cellDate);
            var cell = document.createElement('button');
            cell.type = 'button';
            cell.className = 'calendar-day-cell';
            cell.textContent = String(day);
            cell.setAttribute('aria-label', day + ' de ' + monthNames[month] + ' de ' + year);
            cell.dataset.date = iso;

            if (sameDay(cellDate, today)) {
                cell.classList.add('is-today');
                cell.setAttribute('title', 'Hoje');
            }
            if (sameDay(cellDate, selectedDate)) {
                cell.classList.add('is-selected');
                cell.setAttribute('aria-pressed', 'true');
            } else {
                cell.setAttribute('aria-pressed', 'false');
            }
            if (eventMap[iso]) {
                cell.classList.add('has-event');
                cell.setAttribute('data-has-event', 'true');
                if (iso < todayIso) {
                    cell.classList.add('has-event-past');
                    cell.setAttribute('data-event-past', 'true');
                }
            }

            cell.addEventListener('click', function (ev) {
                var btn = ev.currentTarget;
                var parts = String(btn.dataset.date || '').split('-');
                if (parts.length !== 3) return;
                selectedDate = new Date(
                    parseInt(parts[0], 10),
                    parseInt(parts[1], 10) - 1,
                    parseInt(parts[2], 10),
                    12, 0, 0, 0
                );
                renderCalendar();
                renderEventList();
            });

            daysContainer.appendChild(cell);
        }
    }

    window.prevMonth = function () {
        viewDate.setMonth(viewDate.getMonth() - 1);
        renderCalendar();
        renderEventList();
    };

    window.nextMonth = function () {
        viewDate.setMonth(viewDate.getMonth() + 1);
        renderCalendar();
        renderEventList();
    };

    function init() {
        renderCalendar();
        renderEventList();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
</script>