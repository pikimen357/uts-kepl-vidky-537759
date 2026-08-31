// Data layanan yang dipantau
const services = [
  { name: "Website", status: "online" },
  { name: "API Server", status: "online" },
  { name: "Database", status: "offline" },
  { name: "Payment Gateway", status: "maintenance" }
];

// Fungsi murni: menghitung ringkasan jumlah status
// Dipisah dari DOM supaya bisa diuji (unit test) lewat Node.js
function getStatusSummary(servicesList) {
  return servicesList.reduce((acc, s) => {
    acc[s.status] = (acc[s.status] || 0) + 1;
    return acc;
  }, {});
}

// Fungsi render ke DOM
function renderStatus(servicesList) {
  const container = document.getElementById("status-container");
  container.innerHTML = "";

  servicesList.forEach((s) => {
    const card = document.createElement("div");
    card.className = `status-card status-${s.status}`;
    card.innerHTML = `<h2>${s.name}</h2><p>${s.status.toUpperCase()}</p>`;
    container.appendChild(card);
  });

  document.getElementById("last-updated").textContent =
    new Date().toLocaleString("id-ID");
}

// Hanya jalan di browser, bukan saat diimport di Node.js untuk testing
if (typeof document !== "undefined") {
  renderStatus(services);
}

// Ekspor untuk keperluan unit test (Node.js / CI)
if (typeof module !== "undefined") {
  module.exports = { getStatusSummary };
}
