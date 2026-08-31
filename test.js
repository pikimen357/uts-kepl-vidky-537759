const assert = require("assert");
const { getStatusSummary } = require("./script.js");

const sample = [
  { name: "A", status: "online" },
  { name: "B", status: "online" },
  { name: "C", status: "offline" },
  { name: "D", status: "maintenance" }
];

const summary = getStatusSummary(sample);

assert.strictEqual(summary.online, 2, "Jumlah status online harus 2");
assert.strictEqual(summary.offline, 1, "Jumlah status offline harus 1");
assert.strictEqual(summary.maintenance, 1, "Jumlah status maintenance harus 1");

console.log("Semua test berhasil (passed)!");
