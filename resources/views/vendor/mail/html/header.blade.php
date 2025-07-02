<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="public/assets/img/logo-muni-azul-claro-removebg-preview.png" class="logo"
                    alt="Tres arroyos Logo">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
