const source = require("./siswa.json");
const data = require("./new_data.json");
const fs = require("fs");

const { siswa } = data;
let n = 0;
siswa.forEach((item) => {
  const filter_keys = ["nisn", "nama", "jenis_kelamin"];
  let values = [];
  let cols = Object.keys(item).filter((b) => {
    let exist = true;
    filter_keys.forEach((a) => {
      if (b == a) {
        exist = false;
      }
    });
    return exist;
  });

  cols.forEach((c) => {
    if (typeof item[c] === "string" && item[c].includes("'")) {
      values.push(item[c].split("'").join("\\'"));
    }
    values.push(item[c]);
  });
  cols = cols.join(",");
  let query = `INSERT INTO nilai_siswa (${cols}) VALUES ('${values.join(
    "','"
  )}');\n`;
  fs.appendFile("./query.sql", query, "UTF-8", () => console.log(++n));
});

// create
// function cn() {
//   return Math.floor(Math.random() * (100 - 60) + 60);
// }

// const { rows, mapel } = source;
// const data = [];
// rows.forEach((item) => {
//   const temp = {};
//   mapel.forEach((a) => {
//     temp[a] = cn();
//   });
//   data.push({ ...item, ...temp });
// });

// fs.appendFile("./new_data.json", JSON.stringify({ siswa: data }), "UTF-8", () =>
//   console.log("writed")
// );
