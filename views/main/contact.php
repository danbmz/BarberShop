<main class="contenedor">
    <div class="contact-hero">
        <h2 class="contact-title">Contáctanos</h2>
        <p>¿Estas interesado en nuestros servicios? Contáctanos para reservar tu cita o <a href="/register" class="contact-link">crea una cuenta</a> para reservarla cuando tú quieras, también resolveremos cualquier duda que tengas o si deseas trabajar con nosotros. <span class="contact-span">Solo rellena el formulario.</span></p>
    </div>

    <div class="contact-contenedor">
        <section class="contact-form">
            <h2>Envíanos un Mensaje</h2>
            <form action="#" method="POST">  
                <div class="form-row">
                <div class="form-group-contact">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre completo" required>
                </div>
                <div class="form-group-contact">
                    <label for="telefono">Teléfono</label>
                    <input type="tel" id="telefono" name="telefono" placeholder="Número de telefono" required>
                </div>
                </div>

                <div class="form-group-contact">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="tu@email.com" required>
                </div>

                <div class="form-group-contact">
                    <label for="mensaje">Mensaje</label>
                    <textarea id="mensaje" name="mensaje" rows="4" placeholder="Cuéntanos sobre el servicio que necesitas..." required></textarea>
                </div>

                <button type="submit" class="btn">Enviar Mensaje</button>
            </form>
        </section>

        <!-- Información -->
        <section class="contact-info">
            <div class="info-card">
                <div class="info-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin h-6 w-6 text-accent icon"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path><circle cx="12" cy="10" r="3"></circle></svg>
                </div>
                <div class="info-details">
                    <h3>Ubicación</h3>
                    <p>Av. Principal 123<br>Centro, Ciudad<br>CP 12345</p>
                </div>
            </div>

            <div class="info-card">
                <div class="info-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone h-6 w-6 text-accent icon"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                </div>
                <div class="info-details">
                    <h3>Teléfono</h3>
                    <p>+1 (555) 123-4567<br>WhatsApp: +1 (555) 987-6543</p>
                </div>
            </div>

            <div class="info-card">
                <div class="info-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail h-6 w-6 text-accent icon"><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></svg>
                </div>
                <div class="info-details">
                    <h3>Email</h3>
                    <p>info@barbershopelite.com<br>reservas@barbershopelite.com</p>
                </div>
            </div>

            <div class="info-card">
                <div class="info-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock h-6 w-6 text-accent icon"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                </div>
                <div class="info-details">
                    <h3>Horarios</h3>
                    <p>
                    Lunes - Viernes: 9:00 AM - 8:00 PM<br>
                    Sábados: 8:00 AM - 7:00 PM<br>
                    Domingos: 10:00 AM - 6:00 PM
                    </p>
                </div>
            </div>
        </section>
    </div>
</main>