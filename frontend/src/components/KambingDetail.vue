<script setup lang="ts">
import { ref } from "vue";
import { useRouter } from "vue-router";

const kambing = ref({ category: 0 } as any);
const router = useRouter();

const handleSave = async () => {
  try {
    const resp = await fetch(
      `${import.meta.env.VITE_APP_BASE_URL}/api/kambings`,
      {
        method: "post",
        headers: { "content-type": "application/json" },
        body: JSON.stringify(kambing.value),
      }
    );

    if (resp.status !== 201) {
      throw await resp.text();
    }

    router.push("/");
  } catch (e) {
    console.error(e);
  }
};
</script>

<template>
  <div class="d-flex">
    <div>
      <h4>Detail Kambing</h4>
      <button
        class="btn btn-sm btn-primary"
        @click="
          () => {
            handleSave();
          }
        "
      >
        Save
      </button>
    </div>
  </div>
  <div><strong>Nama</strong></div>
  <div>
    <input
      class="form-control form-control-sm"
      placeholder="Nama..."
      @blur="e=>{
        kambing.name = (e.target as HTMLInputElement).value
      }"
    />
  </div>
  <div><strong>Harga</strong></div>
  <div>
    <input
      class="form-control form-control-sm"
      type="number"
      placeholder="Harga..."
      @blur="e=>{
        kambing.price = parseFloat((e.target as HTMLInputElement).value)
      }"
    />
  </div>
  <div><strong>Kategori</strong></div>

  <select>
    <option :value="0">Kecil</option>
    <option :value="1">Sedang</option>
    <option :value="2">Super</option>
  </select>
</template>
