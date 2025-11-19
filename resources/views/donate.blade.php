@extends('layouts.app')

@section('title', 'Donate - Support Our Mission')

@section('content')
<style>
  /* Import Inter Font */
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

  /* CSS Variables for Consistency */
  :root {
    --primary-blue: #0066FF;
    --primary-blue-dark: #0052CC;
    --primary-blue-light: #3385FF;
    --text-dark: #1f2937;
    --text-light: #6b7280;
    --bg-light: #f9fafb;
    --white: #ffffff;
    
    /* Responsive spacing */
    --spacing-xs: clamp(0.25rem, 1vw, 0.5rem);
    --spacing-sm: clamp(0.5rem, 2vw, 1rem);
    --spacing-md: clamp(1rem, 3vw, 1.5rem);
    --spacing-lg: clamp(1.5rem, 4vw, 2.5rem);
    --spacing-xl: clamp(2rem, 5vw, 4rem);
    
    /* Responsive font sizes */
    --font-xs: clamp(0.75rem, 1.5vw, 0.875rem);
    --font-sm: clamp(0.875rem, 2vw, 1rem);
    --font-base: clamp(1rem, 2.5vw, 1.125rem);
    --font-lg: clamp(1.125rem, 3vw, 1.5rem);
    --font-xl: clamp(1.5rem, 4vw, 2rem);
    --font-2xl: clamp(2rem, 5vw, 3rem);
    --font-3xl: clamp(2.5rem, 6vw, 3.5rem);
  }

  /* Hero Section */
  .donate-hero {
    position: relative;
    padding: clamp(4rem, 10vw, 6.25rem) var(--spacing-md);
    background: linear-gradient(135deg, rgba(0, 102, 255, 0.5) 0%, rgba(0, 82, 204, 0.4) 100%),
                url('https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?q=80&w=2070&auto=format&fit=crop') center/cover;
    color: white;
    text-align: center;
    overflow: hidden;
    background-attachment: fixed;
  }

  .donate-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
    animation: shimmer 3s infinite;
  }

  @keyframes shimmer {
    0% { left: -100%; }
    100% { left: 200%; }
  }

  .donate-hero-content {
    max-width: min(900px, 90vw);
    margin: 0 auto;
    position: relative;
    z-index: 1;
    animation: fadeInUp 1s ease-out;
  }

  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .donate-hero h1 {
    font-family: 'Inter', sans-serif;
    font-size: var(--font-3xl);
    font-weight: 900;
    margin-bottom: clamp(1rem, 2vw, 1.25rem);
    text-shadow: 3px 3px 15px rgba(0, 0, 0, 0.7);
    letter-spacing: -0.02em;
    color: white;
  }

  .donate-hero p {
    font-family: 'Inter', sans-serif;
    font-size: clamp(1.063rem, 2.5vw, 1.3rem);
    opacity: 0.95;
    line-height: 1.7;
    color: white;
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
  }

  /* Section */
  .section {
    padding: clamp(3rem, 8vw, 5rem) var(--spacing-md);
    width: 100%;
    overflow: hidden;
  }

  .container {
    max-width: 1200px;
    margin: 0 auto;
    width: 100%;
  }

  /* Donation Grid */
  .donation-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(min(450px, 100%), 1fr));
    gap: clamp(2rem, 4vw, 2.5rem);
    max-width: 1200px;
    margin: 0 auto;
  }

  /* Donation Form Card */
  .donation-form-card {
    background: white;
    border-radius: clamp(16px, 3vw, 24px);
    padding: clamp(2rem, 5vw, 2.8rem);
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.08);
    animation: fadeInScale 0.8s ease-out;
  }

  @keyframes fadeInScale {
    from {
      opacity: 0;
      transform: scale(0.95);
    }
    to {
      opacity: 1;
      transform: scale(1);
    }
  }

  .donation-form-card h2 {
    font-family: 'Inter', sans-serif;
    font-size: clamp(1.5rem, 3vw, 2rem);
    font-weight: 900;
    color: #1f2937;
    margin-bottom: clamp(1.5rem, 3vw, 1.875rem);
    letter-spacing: -0.02em;
  }

  /* Donation Type Tabs */
  .donation-type-tabs {
    display: flex;
    gap: clamp(0.5rem, 1.5vw, 0.625rem);
    margin-bottom: clamp(1.5rem, 3vw, 1.875rem);
    background: #f3f4f6;
    padding: clamp(0.375rem, 1vw, 0.375rem);
    border-radius: clamp(10px, 2vw, 12px);
  }

  .donation-type-tab {
    flex: 1;
    padding: clamp(0.75rem, 2vw, 0.875rem) clamp(1rem, 2.5vw, 1.25rem);
    background: transparent;
    border: none;
    border-radius: clamp(8px, 1.5vw, 8px);
    font-family: 'Inter', sans-serif;
    font-weight: 700;
    font-size: clamp(0.875rem, 2vw, 0.95rem);
    color: #6b7280;
    cursor: pointer;
    transition: all 0.3s ease;
    white-space: nowrap;
  }

  .donation-type-tab.active {
    background: white;
    color: #0066FF;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  }

  /* Amount Selection */
  .amount-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(min(100px, 100%), 1fr));
    gap: clamp(0.625rem, 1.5vw, 0.75rem);
    margin-bottom: clamp(1.25rem, 3vw, 1.5rem);
  }

  .amount-btn {
    padding: clamp(0.875rem, 2vw, 1rem);
    background: #f9fafb;
    border: 2px solid #e5e7eb;
    border-radius: clamp(10px, 2vw, 12px);
    font-family: 'Inter', sans-serif;
    font-weight: 700;
    font-size: clamp(1rem, 2.2vw, 1.1rem);
    color: #1f2937;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .amount-btn:hover {
    border-color: #0066FF;
    background: rgba(0, 102, 255, 0.05);
  }

  .amount-btn.selected {
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
    border-color: #0066FF;
    color: white;
    box-shadow: 0 4px 15px rgba(0, 102, 255, 0.3);
  }

  /* Custom Amount */
  .custom-amount {
    margin-bottom: clamp(1.5rem, 3vw, 1.875rem);
  }

  .custom-amount label {
    font-family: 'Inter', sans-serif;
    font-size: clamp(0.875rem, 2vw, 0.95rem);
    font-weight: 700;
    color: #1f2937;
    display: block;
    margin-bottom: clamp(0.5rem, 1.5vw, 0.625rem);
  }

  .amount-input-wrapper {
    position: relative;
  }

  .currency-symbol {
    position: absolute;
    left: clamp(1rem, 2.5vw, 1.25rem);
    top: 50%;
    transform: translateY(-50%);
    font-family: 'Inter', sans-serif;
    font-weight: 700;
    font-size: clamp(1.063rem, 2.5vw, 1.2rem);
    color: #6b7280;
    pointer-events: none;
  }

  .amount-input {
    width: 100%;
    padding: clamp(0.875rem, 2vw, 1rem) clamp(1rem, 2.5vw, 1.25rem) clamp(0.875rem, 2vw, 1rem) clamp(2.5rem, 5vw, 3.125rem);
    border: 2px solid #e5e7eb;
    border-radius: clamp(10px, 2vw, 12px);
    font-family: 'Inter', sans-serif;
    font-size: clamp(1rem, 2.2vw, 1.1rem);
    font-weight: 600;
    transition: all 0.3s ease;
  }

  .amount-input:focus {
    outline: none;
    border-color: #0066FF;
    box-shadow: 0 0 0 4px rgba(0, 102, 255, 0.1);
  }

  /* Form Group */
  .form-group {
    margin-bottom: clamp(1.25rem, 3vw, 1.5rem);
  }

  .form-label {
    font-family: 'Inter', sans-serif;
    font-size: clamp(0.875rem, 2vw, 0.95rem);
    font-weight: 700;
    color: #1f2937;
    display: block;
    margin-bottom: clamp(0.5rem, 1.5vw, 0.625rem);
  }

  .form-label .required {
    color: #ef4444;
    margin-left: 4px;
  }

  .form-control {
    width: 100%;
    padding: clamp(0.75rem, 2vw, 0.875rem) clamp(1rem, 2.5vw, 1.25rem);
    border: 2px solid #e5e7eb;
    border-radius: clamp(10px, 2vw, 12px);
    font-family: 'Inter', sans-serif;
    font-size: clamp(0.938rem, 2vw, 1rem);
    transition: all 0.3s ease;
  }

  .form-control:focus {
    outline: none;
    border-color: #0066FF;
    box-shadow: 0 0 0 4px rgba(0, 102, 255, 0.1);
  }

  .form-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(min(200px, 100%), 1fr));
    gap: clamp(1rem, 2.5vw, 1.25rem);
  }

  /* Payment Methods */
  .payment-methods {
    margin-bottom: clamp(1.5rem, 3vw, 1.875rem);
  }

  .payment-methods-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(min(200px, 100%), 1fr));
    gap: clamp(0.625rem, 1.5vw, 0.75rem);
  }

  .payment-method {
    padding: clamp(0.875rem, 2vw, 1rem);
    background: #f9fafb;
    border: 2px solid #e5e7eb;
    border-radius: clamp(10px, 2vw, 12px);
    display: flex;
    align-items: center;
    gap: clamp(0.625rem, 1.5vw, 0.75rem);
    cursor: pointer;
    transition: all 0.3s ease;
    min-height: clamp(60px, 12vw, 70px);
  }

  .payment-method:hover {
    border-color: #0066FF;
    background: rgba(0, 102, 255, 0.05);
  }

  .payment-method.selected {
    border-color: #0066FF;
    background: rgba(0, 102, 255, 0.1);
  }

  .payment-radio {
    width: clamp(18px, 3vw, 20px);
    height: clamp(18px, 3vw, 20px);
    min-width: clamp(18px, 3vw, 20px);
    border: 2px solid #d1d5db;
    border-radius: 50%;
    position: relative;
    flex-shrink: 0;
  }

  .payment-method.selected .payment-radio {
    border-color: #0066FF;
  }

  .payment-method.selected .payment-radio::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: clamp(8px, 2vw, 10px);
    height: clamp(8px, 2vw, 10px);
    background: #0066FF;
    border-radius: 50%;
  }

  .payment-method-info {
    flex: 1;
    min-width: 0;
  }

  .payment-method-name {
    font-family: 'Inter', sans-serif;
    font-weight: 700;
    font-size: clamp(0.875rem, 2vw, 0.95rem);
    color: #1f2937;
    margin-bottom: clamp(0.125rem, 0.5vw, 0.125rem);
  }

  .payment-method-desc {
    font-family: 'Inter', sans-serif;
    font-size: clamp(0.75rem, 1.5vw, 0.85rem);
    color: #6b7280;
  }

  .payment-method-icon {
    font-size: clamp(1.375rem, 3vw, 1.8rem);
    color: #0066FF;
    flex-shrink: 0;
  }

  /* Anonymous Donation */
  .anonymous-donation {
    display: flex;
    align-items: center;
    gap: clamp(0.625rem, 1.5vw, 0.75rem);
    padding: clamp(0.875rem, 2vw, 1rem);
    background: #f9fafb;
    border-radius: clamp(10px, 2vw, 12px);
    margin-bottom: clamp(1.25rem, 3vw, 1.5rem);
  }

  .checkbox-wrapper {
    display: flex;
    align-items: center;
    gap: clamp(0.625rem, 1.5vw, 0.75rem);
    cursor: pointer;
  }

  .checkbox {
    width: clamp(18px, 3vw, 20px);
    height: clamp(18px, 3vw, 20px);
    cursor: pointer;
    flex-shrink: 0;
  }

  .checkbox-label {
    font-family: 'Inter', sans-serif;
    font-size: clamp(0.875rem, 2vw, 0.95rem);
    font-weight: 600;
    color: #1f2937;
    cursor: pointer;
  }

  /* Submit Button */
  .btn-donate {
    width: 100%;
    padding: clamp(1rem, 2.5vw, 1.125rem);
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
    color: white;
    font-family: 'Inter', sans-serif;
    font-weight: 700;
    font-size: clamp(1rem, 2.2vw, 1.15rem);
    border: none;
    border-radius: clamp(10px, 2vw, 12px);
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 8px 25px rgba(0, 102, 255, 0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: clamp(0.625rem, 1.5vw, 0.75rem);
  }

  .btn-donate:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(0, 102, 255, 0.5);
  }

  .btn-donate:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
  }

  /* Donation Summary Card */
  .donation-summary-card {
    background: linear-gradient(135deg, rgba(0, 102, 255, 0.05) 0%, rgba(51, 133, 255, 0.05) 100%);
    border-radius: clamp(16px, 3vw, 24px);
    padding: clamp(2rem, 4vw, 2.2rem);
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.08);
    height: fit-content;
    position: sticky;
    top: 100px;
  }

  .donation-summary-card h3 {
    font-family: 'Inter', sans-serif;
    font-size: clamp(1.25rem, 3vw, 1.5rem);
    font-weight: 900;
    color: #1f2937;
    margin-bottom: clamp(1.25rem, 3vw, 1.5rem);
    letter-spacing: -0.02em;
  }

  .impact-item {
    padding: clamp(1rem, 2.5vw, 1.25rem);
    background: white;
    border-radius: clamp(12px, 2vw, 16px);
    margin-bottom: clamp(0.875rem, 2vw, 1rem);
    border: 2px solid #e5e7eb;
    transition: all 0.3s ease;
  }

  .impact-item:hover {
    border-color: #0066FF;
    box-shadow: 0 4px 15px rgba(0, 102, 255, 0.1);
  }

  .impact-icon {
    width: clamp(45px, 8vw, 50px);
    height: clamp(45px, 8vw, 50px);
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
    border-radius: clamp(10px, 2vw, 12px);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: clamp(0.625rem, 1.5vw, 0.75rem);
  }

  .impact-icon i {
    font-size: clamp(1.25rem, 2.5vw, 1.5rem);
    color: white;
  }

  .impact-title {
    font-family: 'Inter', sans-serif;
    font-weight: 700;
    font-size: clamp(1rem, 2vw, 1.1rem);
    color: #1f2937;
    margin-bottom: clamp(0.375rem, 1vw, 0.5rem);
  }

  .impact-desc {
    font-family: 'Inter', sans-serif;
    font-size: clamp(0.875rem, 2vw, 0.9rem);
    color: #6b7280;
    line-height: 1.6;
  }

  /* Trust Badges */
  .trust-badges {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: clamp(0.75rem, 2vw, 0.938rem);
    margin-top: clamp(1.25rem, 3vw, 1.5rem);
    padding-top: clamp(1.25rem, 3vw, 1.5rem);
    border-top: 2px solid #e5e7eb;
  }

  .trust-badge {
    display: flex;
    align-items: center;
    gap: clamp(0.375rem, 1vw, 0.5rem);
    font-family: 'Inter', sans-serif;
    font-size: clamp(0.75rem, 1.5vw, 0.85rem);
    color: #6b7280;
    white-space: nowrap;
  }

  .trust-badge i {
    color: #0066FF;
    font-size: clamp(1rem, 2vw, 1.2rem);
  }

  /* Other Ways to Give */
  .other-ways {
    background: white;
    border-radius: clamp(16px, 3vw, 24px);
    padding: clamp(2.5rem, 5vw, 3rem);
    margin-top: clamp(2.5rem, 5vw, 3.75rem);
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.08);
  }

  .other-ways h3 {
    font-family: 'Inter', sans-serif;
    font-size: clamp(1.5rem, 3vw, 2rem);
    font-weight: 900;
    color: #1f2937;
    margin-bottom: clamp(1.5rem, 3vw, 1.875rem);
    text-align: center;
    letter-spacing: -0.02em;
  }

  .other-ways-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(min(280px, 100%), 1fr));
    gap: clamp(1.25rem, 3vw, 1.5rem);
  }

  .other-way-item {
    padding: clamp(1.5rem, 3vw, 1.875rem);
    background: #f9fafb;
    border-radius: clamp(12px, 2vw, 16px);
    border: 2px solid #e5e7eb;
    transition: all 0.3s ease;
  }

  .other-way-item:hover {
    border-color: #0066FF;
    background: rgba(0, 102, 255, 0.05);
    transform: translateY(-5px);
  }

  .other-way-icon {
    width: clamp(50px, 10vw, 60px);
    height: clamp(50px, 10vw, 60px);
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: clamp(1rem, 2.5vw, 1.25rem);
  }

  .other-way-icon i {
    font-size: clamp(1.5rem, 3vw, 1.8rem);
    color: white;
  }

  .other-way-title {
    font-family: 'Inter', sans-serif;
    font-weight: 800;
    font-size: clamp(1.063rem, 2.2vw, 1.2rem);
    color: #1f2937;
    margin-bottom: clamp(0.625rem, 1.5vw, 0.75rem);
  }

  .other-way-desc {
    font-family: 'Inter', sans-serif;
    font-size: clamp(0.875rem, 2vw, 0.95rem);
    color: #6b7280;
    line-height: 1.6;
    margin-bottom: clamp(0.75rem, 2vw, 0.938rem);
  }

  .other-way-contact {
    font-family: 'Inter', sans-serif;
    font-size: clamp(0.813rem, 1.8vw, 0.9rem);
    font-weight: 600;
    color: #0066FF;
    line-height: 1.7;
    word-wrap: break-word;
  }

  .other-way-contact strong {
    display: inline-block;
    color: #1f2937;
    min-width: fit-content;
  }

  /* Testimonials */
  .testimonials-section {
    padding: clamp(3rem, 8vw, 5rem) var(--spacing-md);
    background: linear-gradient(135deg, rgba(0, 102, 255, 0.05) 0%, rgba(51, 133, 255, 0.05) 100%);
  }

  .section-title {
    font-family: 'Inter', sans-serif;
    text-align: center;
    font-size: clamp(1.875rem, 4vw, 2.8rem);
    font-weight: 900;
    color: #1f2937;
    margin-bottom: clamp(1rem, 2vw, 1.25rem);
    letter-spacing: -0.02em;
  }

  .testimonials-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(min(320px, 100%), 1fr));
    gap: clamp(1.5rem, 3vw, 1.875rem);
    max-width: 1200px;
    margin: 0 auto;
  }

  .testimonial-card {
    background: white;
    padding: clamp(1.75rem, 4vw, 2.2rem);
    border-radius: clamp(16px, 3vw, 20px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
  }

  .testimonial-quote {
    font-family: 'Inter', sans-serif;
    font-size: clamp(0.938rem, 2vw, 1.05rem);
    color: #4b5563;
    line-height: 1.7;
    margin-bottom: clamp(1rem, 2.5vw, 1.25rem);
    font-style: italic;
  }

  .testimonial-author {
    display: flex;
    align-items: center;
    gap: clamp(0.75rem, 2vw, 0.938rem);
  }

  .author-avatar {
    width: clamp(45px, 8vw, 50px);
    height: clamp(45px, 8vw, 50px);
    min-width: clamp(45px, 8vw, 50px);
    background: linear-gradient(135deg, #0066FF 0%, #0052CC 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: clamp(1.063rem, 2.2vw, 1.2rem);
  }

  .author-info {
    font-family: 'Inter', sans-serif;
    min-width: 0;
  }

  .author-name {
    font-weight: 700;
    color: #1f2937;
    margin-bottom: clamp(0.125rem, 0.5vw, 0.125rem);
    font-size: clamp(0.938rem, 2vw, 1rem);
  }

  .author-title {
    font-size: clamp(0.75rem, 1.5vw, 0.85rem);
    color: #6b7280;
  }

  /* Security Badge */
  .security-badge {
    text-align: center;
    margin-top: clamp(1rem, 2.5vw, 1.25rem);
    font-family: 'Inter', sans-serif;
    font-size: clamp(0.75rem, 1.5vw, 0.85rem);
    color: #6b7280;
  }

  /* Responsive Breakpoints */
  
  /* Extra Small Mobile (320px - 479px) */
  @media (max-width: 479px) {
    .donate-hero {
      background-attachment: scroll;
    }

    .donation-grid {
      grid-template-columns: 1fr;
    }

    .donation-summary-card {
      position: relative;
      top: 0;
    }

    .amount-grid {
      grid-template-columns: repeat(2, 1fr);
    }

    .form-row {
      grid-template-columns: 1fr;
    }

    .payment-methods-grid {
      grid-template-columns: 1fr;
    }

    .trust-badges {
      flex-direction: column;
      align-items: flex-start;
    }
  }

  /* Mobile Landscape (480px - 767px) */
  @media (min-width: 480px) and (max-width: 767px) {
    .donate-hero {
      background-attachment: scroll;
    }

    .donation-grid {
      grid-template-columns: 1fr;
    }

    .donation-summary-card {
      position: relative;
      top: 0;
    }

    .amount-grid {
      grid-template-columns: repeat(3, 1fr);
    }

    .payment-methods-grid {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  /* Tablet Portrait (768px - 991px) */
  @media (min-width: 768px) and (max-width: 991px) {
    .donation-grid {
      grid-template-columns: 1fr;
    }

    .donation-summary-card {
      position: relative;
      top: 0;
    }

    .amount-grid {
      grid-template-columns: repeat(3, 1fr);
    }
  }

  /* Tablet Landscape & Desktop (992px+) */
  @media (min-width: 992px) {
    .donation-grid {
      grid-template-columns: 1.5fr 1fr;
    }
  }

  /* Large Desktop (1200px+) */
  @media (min-width: 1200px) {
    .amount-grid {
      grid-template-columns: repeat(3, 1fr);
    }
  }

  /* Landscape Orientation on Mobile */
  @media (max-height: 500px) and (orientation: landscape) {
    .donate-hero {
      padding: 3rem var(--spacing-md);
      background-attachment: scroll;
    }

    .donation-summary-card {
      position: relative;
      top: 0;
    }
  }

  /* High DPI / Retina Displays */
  @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
    .donate-hero {
      background-image: linear-gradient(135deg, rgba(0, 102, 255, 0.5) 0%, rgba(0, 82, 204, 0.4) 100%),
                        url('https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?q=80&w=2070&auto=format&fit=crop&dpr=2');
    }
  }

  /* Reduced Motion for Accessibility */
  @media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
      animation-duration: 0.01ms !important;
      animation-iteration-count: 1 !important;
      transition-duration: 0.01ms !important;
    }
  }

  /* Print Styles */
  @media print {
    .donate-hero,
    .testimonials-section {
      display: none;
    }

    .donation-form-card form button {
      display: none;
    }
  }

  /* Touch device optimizations */
  @media (hover: none) and (pointer: coarse) {
    .amount-btn:hover,
    .btn-donate:hover,
    .other-way-item:hover {
      transform: none;
    }

    .amount-btn:active,
    .btn-donate:active {
      transform: scale(0.98);
    }
  }
</style>

<div class="w-full">
    <!-- Hero Section -->
    <section class="donate-hero">
        <div class="donate-hero-content">
            <h1>Make a Difference Today</h1>
            <p>Your generosity transforms lives. Every donation supports our mission to provide hope and healing.</p>
        </div>
    </section>

    <!-- Donation Form Section -->
    <section class="section">
        <div class="container">
            <div class="donation-grid">
                <!-- Donation Form -->
                <div class="donation-form-card">
                    <h2>Choose Your Donation</h2>

                    <form action="{{ route('donate.process') }}" method="POST" id="donationForm">
                        @csrf

                        <!-- Donation Type -->
                        <div class="donation-type-tabs">
                            <button type="button" class="donation-type-tab active" data-type="one-time">
                                One-Time
                            </button>
                            <button type="button" class="donation-type-tab" data-type="monthly">
                                Monthly
                            </button>
                        </div>
                        <input type="hidden" name="donation_type" id="donationType" value="one-time">

                        <!-- Amount Selection -->
                        <div class="amount-grid">
                            <button type="button" class="amount-btn" data-amount="10">$10</button>
                            <button type="button" class="amount-btn" data-amount="25">$25</button>
                            <button type="button" class="amount-btn selected" data-amount="50">$50</button>
                            <button type="button" class="amount-btn" data-amount="100">$100</button>
                            <button type="button" class="amount-btn" data-amount="250">$250</button>
                            <button type="button" class="amount-btn" data-amount="500">$500</button>
                        </div>

                        <!-- Custom Amount -->
                        <div class="custom-amount">
                            <label for="customAmount">Or Enter Custom Amount</label>
                            <div class="amount-input-wrapper">
                                <span class="currency-symbol">$</span>
                                <input type="number" 
                                       name="amount" 
                                       id="customAmount" 
                                       class="amount-input" 
                                       placeholder="Enter amount"
                                       value="50"
                                       min="5"
                                       step="1"
                                       required>
                            </div>
                        </div>

                        <!-- Personal Information -->
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">First Name <span class="required">*</span></label>
                                <input type="text" name="first_name" class="form-control" placeholder="John" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Last Name <span class="required">*</span></label>
                                <input type="text" name="last_name" class="form-control" placeholder="Doe" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Email Address <span class="required">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="john.doe@example.com" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" name="phone" class="form-control" placeholder="+263 xxx xxx xxx">
                        </div>

                        <!-- Payment Method -->
                        <div class="payment-methods">
                            <label class="form-label">Payment Method <span class="required">*</span></label>
                            <div class="payment-methods-grid">
                                <label class="payment-method selected">
                                    <div class="payment-radio"></div>
                                    <div class="payment-method-info">
                                        <div class="payment-method-name">Credit/Debit Card</div>
                                        <div class="payment-method-desc">Visa, Mastercard, Amex</div>
                                    </div>
                                    <i class="fas fa-credit-card payment-method-icon"></i>
                                    <input type="radio" name="payment_method" value="card" checked hidden>
                                </label>

                                <label class="payment-method">
                                    <div class="payment-radio"></div>
                                    <div class="payment-method-info">
                                        <div class="payment-method-name">Mobile Money</div>
                                        <div class="payment-method-desc">EcoCash, OneMoney</div>
                                    </div>
                                    <i class="fas fa-mobile-alt payment-method-icon"></i>
                                    <input type="radio" name="payment_method" value="mobile_money" hidden>
                                </label>

                                <label class="payment-method">
                                    <div class="payment-radio"></div>
                                    <div class="payment-method-info">
                                        <div class="payment-method-name">Bank Transfer</div>
                                        <div class="payment-method-desc">Direct bank deposit</div>
                                    </div>
                                    <i class="fas fa-university payment-method-icon"></i>
                                    <input type="radio" name="payment_method" value="bank_transfer" hidden>
                                </label>

                                <label class="payment-method">
                                    <div class="payment-radio"></div>
                                    <div class="payment-method-info">
                                        <div class="payment-method-name">PayPal</div>
                                        <div class="payment-method-desc">Fast & secure</div>
                                    </div>
                                    <i class="fab fa-paypal payment-method-icon"></i>
                                    <input type="radio" name="payment_method" value="paypal" hidden>
                                </label>
                            </div>
                        </div>

                        <!-- Anonymous Donation -->
                        <div class="anonymous-donation">
                            <label class="checkbox-wrapper">
                                <input type="checkbox" name="anonymous" class="checkbox">
                                <span class="checkbox-label">Make this donation anonymous</span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn-donate">
                            <i class="fas fa-heart"></i>
                            <span>Donate Now</span>
                        </button>

                        <div class="security-badge">
                            🔒 Your donation is secure and tax-deductible
                        </div>
                    </form>
                </div>

                <!-- Donation Summary -->
                <div class="donation-summary-card">
                    <h3>Your Impact</h3>

                    <div class="impact-item">
                        <div class="impact-icon">
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                        <div class="impact-title">$50 Can Provide</div>
                        <div class="impact-desc">One week of meals for a person in rehabilitation</div>
                    </div>

                    <div class="impact-item">
                        <div class="impact-icon">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <div class="impact-title">$100 Can Provide</div>
                        <div class="impact-desc">Professional counseling session for one individual</div>
                    </div>

                    <div class="impact-item">
                        <div class="impact-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="impact-title">$250 Can Provide</div>
                        <div class="impact-desc">One month of shelter and care for someone in recovery</div>
                    </div>

                    <div class="trust-badges">
                        <div class="trust-badge">
                            <i class="fas fa-lock"></i>
                            <span>Secure</span>
                        </div>
                        <div class="trust-badge">
                            <i class="fas fa-shield-alt"></i>
                            <span>Protected</span>
                        </div>
                        <div class="trust-badge">
                            <i class="fas fa-certificate"></i>
                            <span>Tax Deductible</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Other Ways to Give -->
            <div class="other-ways">
                <h3>Other Ways to Support Us</h3>
                <div class="other-ways-grid">
                    <div class="other-way-item">
                        <div class="other-way-icon">
                            <i class="fas fa-money-check-alt"></i>
                        </div>
                        <div class="other-way-title">Bank Transfer</div>
                        <div class="other-way-desc">
                            Direct bank deposit for larger donations or organizational giving.
                        </div>
                        <div class="other-way-contact">
                            <strong>Bank:</strong> Banc ABC<br>
                            <strong>Account USD:</strong> 12655006633189<br>
                            <strong>Account ZIG:</strong> 510-12655005402020
                        </div>
                    </div>

                    <div class="other-way-item">
                        <div class="other-way-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <div class="other-way-title">Mobile Money</div>
                        <div class="other-way-desc">
                            Send donations via EcoCash or OneMoney for quick support.
                        </div>
                        <div class="other-way-contact">
                            <strong>EcoCash:</strong> +263 772 600 778
                        </div>
                    </div>

                    <div class="other-way-item">
                        <div class="other-way-icon">
                            <i class="fas fa-gift"></i>
                        </div>
                        <div class="other-way-title">In-Kind Donations</div>
                        <div class="other-way-desc">
                            Donate goods, supplies, or services to support our programs.
                        </div>
                        <div class="other-way-contact">
                            <strong>Email:</strong> queenofpeace.org@gmail.com<br>
                            <strong>Phone:</strong> +263 77 7 942 996
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials-section">
        <div class="container">
            <h2 class="section-title" style="margin-bottom: clamp(2rem, 5vw, 3rem);">What Donors Say</h2>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="testimonial-quote">
                        "Supporting Queen of Peace has been incredibly rewarding. Knowing my contribution helps transform lives gives me a sense of purpose."
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">JM</div>
                        <div class="author-info">
                            <div class="author-name">John Moyo</div>
                            <div class="author-title">Monthly Donor</div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="testimonial-quote">
                        "The transparency and impact reports give me confidence that my donations are making a real difference in our community."
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">TN</div>
                        <div class="author-info">
                            <div class="author-name">Tendai Ncube</div>
                            <div class="author-title">Corporate Partner</div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <div class="testimonial-quote">
                        "I've seen firsthand the incredible work Queen of Peace does. Every dollar truly counts towards healing and recovery."
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">SC</div>
                        <div class="author-info">
                            <div class="author-name">Sarah Chikomba</div>
                            <div class="author-title">Annual Donor</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
// Donation Type Toggle
document.querySelectorAll('.donation-type-tab').forEach(tab => {
    tab.addEventListener('click', function() {
        document.querySelectorAll('.donation-type-tab').forEach(t => t.classList.remove('active'));
        this.classList.add('active');
        document.getElementById('donationType').value = this.dataset.type;
    });
});

// Amount Selection
document.querySelectorAll('.amount-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.amount-btn').forEach(b => b.classList.remove('selected'));
        this.classList.add('selected');
        document.getElementById('customAmount').value = this.dataset.amount;
    });
});

// Custom Amount Input
document.getElementById('customAmount').addEventListener('input', function() {
    if (this.value) {
        document.querySelectorAll('.amount-btn').forEach(b => b.classList.remove('selected'));
    }
});

// Payment Method Selection
document.querySelectorAll('.payment-method').forEach(method => {
    method.addEventListener('click', function() {
        document.querySelectorAll('.payment-method').forEach(m => m.classList.remove('selected'));
        this.classList.add('selected');
        this.querySelector('input[type="radio"]').checked = true;
    });
});

// Form Submission
document.getElementById('donationForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Get form data
    const formData = new FormData(this);
    const amount = formData.get('amount');
    const paymentMethod = formData.get('payment_method');
    
    // Show loading state
    const submitBtn = this.querySelector('.btn-donate');
    const originalHTML = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span>Processing...</span>';
    submitBtn.disabled = true;
    
    // Here you would integrate with your payment gateway
    // For demonstration, we'll simulate a delay
    setTimeout(() => {
        alert(`Thank you for your donation of $${amount}!\n\nPayment method: ${paymentMethod}\n\nYou will receive a confirmation email shortly.`);
        submitBtn.innerHTML = originalHTML;
        submitBtn.disabled = false;
        // Redirect to thank you page
        // window.location.href = '/donate/thank-you';
    }, 2000);
});
</script>
@endsection