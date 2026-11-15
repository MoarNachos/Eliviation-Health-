#!/bin/sh
set -eu
# Supply the original source path. No audio removal; playback starts muted in the theme.
source_video=$1
asset_dir=$(CDPATH= cd -- "$(dirname -- "$0")/../../elivation/assets/video" && pwd)
ffmpeg -hide_banner -loglevel error -y -i "$source_video" -map 0:v:0 -map 0:a:0 -vf 'scale=720:1280:force_original_aspect_ratio=increase,crop=720:1280,setsar=1' -r 30 -c:v libx264 -preset slow -b:v 1500k -maxrate 1800k -bufsize 3000k -pix_fmt yuv420p -c:a aac -b:a 128k -movflags +faststart -map_metadata -1 "$asset_dir/home-visit-720.mp4"
ffmpeg -hide_banner -loglevel error -y -i "$source_video" -map 0:v:0 -map 0:a:0 -vf 'scale=720:1280:force_original_aspect_ratio=increase,crop=720:1280,setsar=1' -r 30 -c:v libvpx-vp9 -deadline good -cpu-used 3 -row-mt 1 -threads 4 -b:v 1500k -crf 32 -c:a libopus -b:a 96k -map_metadata -1 "$asset_dir/home-visit-720.webm"
# 1.5 seconds is the handshake; 24 seconds is the living-room client-care shot.
ffmpeg -hide_banner -loglevel error -y -ss 1.5 -i "$source_video" -vf 'scale=720:1280:force_original_aspect_ratio=increase,crop=720:1280' -frames:v 1 -q:v 4 -update 1 "$asset_dir/home-visit-doorway.jpg"
ffmpeg -hide_banner -loglevel error -y -ss 24 -i "$source_video" -vf 'scale=720:1280:force_original_aspect_ratio=increase,crop=720:1280' -frames:v 1 -q:v 4 -update 1 "$asset_dir/home-visit-care.jpg"
