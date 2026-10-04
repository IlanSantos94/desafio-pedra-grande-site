MAPPING BASE44 -> NOSSO CSS (mapear e alinhar)
------------------------------------------------

CORES (tokens RGB/hex):
Base44: bg-dpg-alloy #F4F6F5  — nosso tem --dpg-alloy #F4F6F5 OK
        bg-dpg-green #0A3D2E  — nosso --dpg-green #0A3D2E OK
        bg-dpg-green-soft #E8F0EC — nosso --dpg-green-soft #E8F0EC OK
        bg-dpg-obsidian #000 — nosso --dpg-obsidian #000000 OK
        bg-dpg-rule #E4E8E5 — nosso --dpg-rule #E4E8E5 OK
        dpg-ink #121413 — nosso --dpg-ink #121413 OK
        hover: dpg-green-hover #0E4A38 — FALTA no nosso :root (--dpg-green-hover)

OPACIDADES dpg-ink/XX:
Base44 usa .text-dpg-ink/30,40,45,50,55,60,70,75,80 — nosso tem --dpg-ink-30,40,45,50,60
FALTANDO: --dpg-ink-55, --dpg-ink-70, --dpg-ink-75, --dpg-ink-80

DIVERGENCIAS CRITICAS:
1. Adicionar --dpg-green-hover: #0E4A38 (igual Base44) — nosso atual é #072C21
2. Completar opacidades para evitar desalinhamentos se usarem classes com /55,/70,/75,/80
3. Manter estrutura enxuta, sem adicionar classes órfãs

RECOMENDACAO: aplicar apenas adições no :root (conservador).