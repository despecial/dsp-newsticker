# WordPress Newsticker Plugin

## Beschreibung

Ein einfaches und effektives WordPress Plugin für die Anzeige von Newsticker-Nachrichten.
Das Plugin bietet eine scrollende Textanzeige mit Admin-Panel zur Verwaltung der Inhalte.

## Features

- ✅ **Standardmäßig aktiviert** - Plugin ist nach Installation sofort einsatzbereit
- ✅ **Ohne jQuery-Abhängigkeit** - Verwendet reines JavaScript
- ✅ **Styled Toggle-Switch** - Schöner Toggle im Admin-Bereich
- ✅ **Rich Text Editor** - Vollständiger WordPress Editor für Inhalte
- ✅ **Responsive Design** - Angepasste Darstellung für Mobile und Desktop
- ✅ **Viewport Animation** - Animation startet nur wenn sichtbar
- ✅ **Performance optimiert** - CSS/JS laden nur bei Bedarf

## Installation

1. Erstellen Sie einen Ordner `dsp-newsticker/` im WordPress Plugin-Verzeichnis (`/wp-content/plugins/`)
2. Kopieren Sie alle Dateien in die entsprechende Struktur:
   ```
   dsp-newsticker/
   ├── newsticker.php
   └── assets/
       ├── newsticker.css
       ├── newsticker.js
       └── admin.css
   ```
3. Aktivieren Sie das Plugin im WordPress Admin-Bereich unter "Plugins"

## Verwendung

### Shortcode
Verwenden Sie den Shortcode `[newsticker]` um den Newsticker anzuzeigen:

**In Seiten/Beiträgen:**
```
[newsticker]
```

**In Templates:**
```php
<?php echo do_shortcode('[newsticker]'); ?>
```

**In Widgets:**
Fügen Sie den Shortcode `[newsticker]` direkt in Text-Widgets ein.

### Admin-Einstellungen

Gehen Sie zu **Einstellungen → Newsticker** um:
- Den Newsticker zu aktivieren/deaktivieren
- Den Inhalt zu bearbeiten
- HTML-Tags und Links hinzuzufügen

## Konfiguration

### Beispiel-Inhalt
Das Plugin wird mit folgendem Beispiel-Inhalt installiert:
```html
<span>LAST MINUTE Angebot!</span>
<span>30% auf Alles</span>
<span>Packt eure Familie und Freunde ein!</span>
<span><a href="#"><strong>Jetzt shoppen & sparen</span>
```

### Styling anpassen
Die CSS-Datei `assets/newsticker.css` kann angepasst werden:
- Hintergrundfarbe: `background-color: #01494f;` (.newsticker)
- Textfarbe: `color: #fff;`  (.newsticker)
- Schriftgröße: `font-size: 18px;` (Mobile) / `20px;` (Desktop)
- Animationsgeschwindigkeit: `animation: scroll 20s linear infinite;`

## Technische Details

### Dateien
- `newsticker.php` - Hauptplugin-Datei mit PHP-Klasse
- `assets/newsticker.css` - Frontend-Styles
- `assets/newsticker.js` - Frontend-JavaScript (ohne jQuery)
- `assets/admin.css` - Admin-Panel Styles

### Hooks & Actions
- `admin_menu` - Fügt Admin-Menü hinzu
- `admin_init` - Registriert Einstellungen
- `wp_enqueue_scripts` - Lädt Assets nur bei Bedarf
- `admin_enqueue_scripts` - Lädt Admin-Styles

### Berechtigungen
- Mindestberechtigung: `edit_posts`
- Alle Rollen mit Backend-Zugriff können das Plugin verwalten

## Browser-Kompatibilität

- Chrome/Edge: ✅
- Firefox: ✅
- Safari: ✅
- Internet Explorer 11+: ✅

## Changelog

### Version 1.0.0
- Erste Veröffentlichung
- Shortcode `[newsticker]` implementiert
- Admin-Panel mit Toggle-Switch
- Rich Text Editor Integration
- Responsive Design
- Viewport-basierte Animation
- Performance-Optimierungen

## Support

Bei Fragen oder Problemen wenden Sie sich an: **despecial.com**

## Lizenz
Dieses Plugin ist unter der GPL v2 oder höher lizenziert.
