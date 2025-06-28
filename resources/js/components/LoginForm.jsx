import React from 'react';

export default function LoginForm() {
  return (
    <>
      <form action="/login/authenticate" method="POST" className="flex flex-col">
        <input type="hidden" name="_token" value={document.querySelector('meta[name="csrf-token"]').content} />

        <label className="font-bold mt-4 mb-1" htmlFor="email">Email</label>
        <input
          type="email"
          name="email"
          id="email"
          required
          className="w-full p-3 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-teal-500"
        />

        <label className="font-bold mt-6 mb-1" htmlFor="password">Password</label>
        <input
          type="password"
          name="password"
          id="password"
          required
          className="w-full p-3 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-teal-500"
        />

        <button
          type="submit"
          className="mt-8 bg-blue-900 text-white py-3 rounded-md text-lg font-semibold hover:bg-blue-800 transition-colors"
        >
          Login
        </button>

        <div className="flex justify-between items-center mt-4 text-sm text-gray-700">
          <label className="flex items-center gap-2">
            <input type="checkbox" name="remember" className="w-4 h-4 rounded border-gray-300" />
            Remember me
          </label>
          <a href="#" className="text-blue-900 hover:underline">Forgot password?</a>
        </div>

        <a
          href="#"
          className="mt-6 block text-center border border-blue-900 text-blue-900 py-3 rounded-md font-semibold hover:bg-blue-900 hover:text-white transition-colors"
        >
          Sign Up
        </a>

        <div className="mt-8 text-center text-sm text-gray-600">
          <p className="mb-4">Or, login with</p>
          <div className="flex justify-center gap-6">
            <a href="#" className="text-teal-600 font-bold hover:underline">Facebook</a>
            <a href="#" className="text-teal-600 font-bold hover:underline">LinkedIn</a>
            <a href="#" className="text-teal-600 font-bold hover:underline">Google</a>
          </div>
        </div>
      </form>
    </>
  );
}
