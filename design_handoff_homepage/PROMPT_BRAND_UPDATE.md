# Prompt: apply the new logo + navy palette (paste into Claude Code first)

The brand has been updated to match the official Elivation logo. Read `design_handoff_homepage/BRAND_GUIDE.md` (the Color and Logo sections) and `design_handoff_homepage/design/tokens/colors.css`, then update everything already built.

1. **Logo:** copy `design/assets/logo-navy.png` (for light backgrounds) and `logo-white.png` (for dark backgrounds and photos) into the theme. Replace the text wordmark in the header (navy version, 40px tall) and the footer (white version, 48px tall). Alt text: "Elivation Health". Leave a TODO to swap in an SVG when the client supplies one.
2. **Palette:** the green "pine" tokens are now **navy**, and "glass" is now **sky** (the logo's blue). Replace every old value with the new one:
   - #10463F → #16355A
   - #0C3530 → #0F2846
   - #082522 → #0A1C33
   - #165A50 → #1F4673
   - #1F6F62 → #2C5A8C
   - #ECF4F2 → #EEF3F9
   - #73AFA1 → #8FB0D6
   - rgba(8,37,34,x) → rgba(10,28,51,x)
   - rgba(31,111,98,x) → rgba(44,90,140,x)
   - Rename the tokens `--pine-*` → `--navy-*` and `--glass-*` → `--sky-*`, and add `--sky-500: #20AEE0`.
3. **Coral (#E2532E)** stays as the color for primary CTAs. Use sky only for accents and highlights, never for body text on white.
4. Use `design/templates/homepage/Homepage.dc.html` and `design/templates/treatment/Treatment.dc.html` (open them in a browser) as the visual reference for the updated look.
5. Search the codebase and report any hardcoded hex values left over. Every color should come from tokens.

Show me a diff summary before committing.
