# Home-visit video

Source requested as `video-candidates/home-visit-flu.mp4`. The matching original is now staged at that path. The matching source was found at `Downloads/WhatsApp Video 2026-11-12 at 02.17.43.mp4`, identical to the previously staged `elivation-2026-11-12.mp4` (SHA-256 `d3e80f1e3042f48de68284dc6f16e5f24d583d4aa6f889d31a7f511b83b05edf`). It matches the doorway handshake, flu-season narration and living-room care sequence. Original: 480×848, 31.205 seconds, H.264/AAC, burned-in captions. 720×1280 output is upscaled, not additional captured detail.

Reproduce with `sh tools/video/encode.sh /absolute/path/to/source.mp4`. H.264 is 1.5 Mbps target with faststart; VP9 uses a 1.5 Mbps target and CRF 32. Audio is retained in AAC/Opus. Posters use the handshake at 1.5 seconds and living-room shot at 24 seconds. Both placements use exactly the same assets.

Playback requires a user click. HTML starts muted with preload none and no autoplay. JavaScript chooses the mobile poster, exposes a large play button, unmutes only on click, shows native controls, and pauses the player when it leaves the viewport or the tab becomes hidden. It never automatically resumes, including for reduced-motion users. Without JavaScript, native controls remain available. Burned-in captions are supplemented by an optional English caption track and a transcript retained in source for client review. The visible transcript was removed at the user’s request.

The original recording contains health outcome claims and identifiable people. All approval/consent/disclosure items are in `elivation/TODO.md`. VideoObject.uploadDate stays unset until a real publication date is supplied. Do not fabricate a date for a structured-data validator.

## Validation and deployment

The homepage and Relief page were deployed only under `/design-review/`; root production and booking are unchanged. Initial requests include neither MP4 nor WebM. Browser checks confirm muted initial state, sound and native controls on Play, and pause offscreen. The shared video is rendered once per page. Screenshots at 375px and 1280px are in `screenshots/video/`.

The hosted mobile Lighthouse run scored **70 Performance / 100 Accessibility**. The requested >90 performance threshold is **not met**. The report records slow document response and late web-font shifts; do not present the task as performance-complete. The video does not download during initial navigation. The later CTA gap correction does not alter resource loading. `validation.json` records the tested URL and checks. Consent, claims and publication-date items remain client TODOs.
