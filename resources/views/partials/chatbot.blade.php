<button class="chat-bubble" onclick="toggleChat()" aria-label="Chat asisten wisata"><span id="chatIcon"><i class="bi bi-chat-dots-fill"></i></span></button>
<div class="chat-window" id="chatWindow">
    <div class="chat-head">
        <div class="av"><i class="bi bi-headset"></i></div>
        <div style="flex:1">
            <div style="font-weight:800;font-size:.92rem">Layanan Informasi Wisata</div>
            <div style="font-size:.72rem;opacity:.75">Pusat bantuan informasi Samarinda</div>
        </div>
        <button onclick="toggleChat()" style="background:none;border:none;color:#fff;font-size:1.1rem;cursor:pointer" aria-label="Tutup"><i class="bi bi-x-lg"></i></button>
    </div>
    <div class="chat-msgs" id="chatMsgs"></div>
    <div class="chat-quick">
        <button type="button" onclick="quickChat('Destinasi wisata apa saja?')"><i class="bi bi-compass me-1"></i> Destinasi</button>
        <button type="button" onclick="quickChat('Berapa harga tiket masuk?')"><i class="bi bi-ticket-perforated me-1"></i> Tiket</button>
        <button type="button" onclick="quickChat('Jam buka destinasi?')"><i class="bi bi-clock me-1"></i> Jam buka</button>
        <button type="button" onclick="quickChat('Kuliner khas Samarinda?')"><i class="bi bi-cup-hot me-1"></i> Kuliner</button>
    </div>
    <div class="chat-input">
        <input id="chatInput" type="text" placeholder="Ketik pertanyaan..." autocomplete="off">
        <button type="button" onclick="sendChat()" aria-label="Kirim"><i class="bi bi-send-fill"></i></button>
    </div>
</div>
