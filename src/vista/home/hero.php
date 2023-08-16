<section class="hero">
    
<form class="hero-form">
            <h2 class="hero-h2">Consulta de Líneas de Autobús</h2>
            <div class="hero-form-group">
                <label class="hero-label" for="hero-hora">
                    <i class="fas fa-calendar-alt"></i> Horario
                </label>
                <input class="hero-input" type="datetime-local" id="hero-hora" name="hora" required>
            </div>
            <div class="hero-form-group">
                <label class="hero-label" for="hero-destino">
                    <i class="fas fa-map-marker-alt"></i> Destino
                </label>
                <input class="hero-input" type="text" id="hero-destino" name="destino" placeholder="Ej: Ciudad X" required>
            </div>
            <div class="hero-form-group">
                <label class="hero-label" for="hero-salida">
                    <i class="fas fa-location-arrow"></i> Salida
                </label>
                <input class="hero-input" type="text" id="hero-salida" name="salida" placeholder="Ej: Ciudad Y" required>
            </div>
            <div class="hero-form-group">
                <label class="hero-label" for="hero-pasajeros">
                    <i class="fas fa-users"></i> Número de Pasajeros
                </label>
                <input class="hero-input" type="number" id="hero-pasajeros" name="pasajeros" placeholder="Ej: 2" required>
            </div>
            <button type="submit" class="hero-button">
                 Consultar
            </button>
        </form>
    <section class="hero-txt">Viaja con Via<span style="font-size:1em;color:rgb(51, 87, 153);">Uy</span>, viaja <span id="hero-txt-span" class="hero-txt-span">Facil</span></section>
</section>

<script src="/via_uy/src/public/js/home/hero.js"></script>