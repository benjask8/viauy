<section class="hero">
    <!-- <section class="hero-txt">Viaja con Via<span style="font-size:1em;color:rgb(51, 87, 153);">Uy</span>, viaja <span id="hero-txt-span" class="hero-txt-span">Facil</span></section> -->
    <section class="hero-txt">
        <h2 class="hero-txt-title">
            Encuentra, Reserva y Compra tus Boletos de Autobús en viaUy, la Forma Más Fácil y Rápida de Viajar
        </h2>
        <p class="hero-txt-desc">¡Tu Viaje Perfecto Comienza Aquí!</p>
    </section>


    <form class="hero-form" action="index.php?c=actions&m=buscar" method="GET">
            <div class="hero-form-group">
                <label class="hero-label" for="hero-salida">
                    Origen
                </label>
                <input class="hero-input" type="text" id="hero-salida" name="salida" placeholder="Origen..." required>
            </div>
            <div class="hero-form-group">
                <label class="hero-label" for="hero-destino">
                    Destino
                </label>
                <input class="hero-input" type="text" id="hero-destino" name="destino" placeholder="Destino..." required>
            </div>
            <div class="hero-form-group">
                <label class="hero-label" for="hero-hora">
                    Ida
                </label>
                <input class="hero-input" type="datetime-local" id="hero-hora" name="hora" required>
            </div>
            <div class="hero-form-group">
                <label class="hero-label" for="hero-pasajeros">
                    Pasajeros
                </label>
                <input class="hero-input" type="number" id="hero-pasajeros" name="pasajeros" placeholder="Pasajeros..." required>
            </div>
            <button type="submit" class="hero-button">
            <i class="fa-solid fa-magnifying-glass"></i> Buscar
            </button>
        </form>
</section>

<script src="public/js/home/hero.js"></script>