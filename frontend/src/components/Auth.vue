<script setup lang="ts">
import { useRouter } from "vue-router";
import { ctx } from "../main";

const router = useRouter();

const init = async () => {
  try {
    const prompt = window.prompt("Enter password:");

    if (prompt && prompt !== "") {
      const resp = await fetch(
        `${import.meta.env.VITE_APP_BASE_URL}/api/login`,
        {
          method: "post",
          headers: { "content-type": "application/json" },
          body: JSON.stringify({ password: prompt }),
        }
      );

      if (resp.status !== 200) {
        throw await resp.text();
      }

      const tok = await resp.text();

      ctx.value.token = tok;
    }
  } catch (e) {
    console.error(e);
  } finally {
    router.push("/");
  }
};

init();
</script>

<template></template>
