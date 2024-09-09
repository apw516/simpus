<table class="table table-bordered">
    <tr class="font-italic text-bold">
        <td>Uang Yang Dibayar</td>
        <td>RP. {{ number_format($arrgtt[0]['tu'], 2) }}</td>
    </tr>
    <tr class="font-italic text-bold">
        <td>Total Tagihan</td>
        <td>{{ $arrgtt[0]['vgtt']}}</td>
    </tr>
    <tr>
        <td class="text-bold">Kembalian</td>
        <td class="text-bold text-danger">RP. {{ number_format($kembalian, 2) }}</td>
    </tr>
</table>
