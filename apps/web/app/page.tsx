const pillars = ['Discover partner gyms', 'Buy flexible credits', 'Check in securely', 'Earn rewards'];

export default function HomePage() {
  return (
    <main className="min-h-screen bg-slate-950 px-6 py-16 text-white">
      <section className="mx-auto max-w-5xl">
        <p className="text-sm uppercase tracking-[0.3em] text-emerald-300">RoamFit Philippines</p>
        <h1 className="mt-6 text-5xl font-bold tracking-tight md:text-7xl">Train Anywhere in the Philippines.</h1>
        <p className="mt-6 max-w-2xl text-lg text-slate-300">
          RoamFit connects members with verified independent fitness businesses through a secure credit-based marketplace built for travel, routine continuity, and partner growth.
        </p>
        <div className="mt-10 grid gap-4 md:grid-cols-4">
          {pillars.map((pillar) => (
            <div key={pillar} className="rounded-2xl border border-white/10 bg-white/5 p-5 shadow-xl shadow-emerald-950/20">
              <span className="text-emerald-300">●</span>
              <h2 className="mt-3 font-semibold">{pillar}</h2>
            </div>
          ))}
        </div>
      </section>
    </main>
  );
}
